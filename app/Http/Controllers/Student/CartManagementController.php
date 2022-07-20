<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\CartManagement;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\CouponCourse;
use App\Models\CouponInstructor;
use App\Models\Course;
use App\Models\Order;
use App\Models\Order_billing_address;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\State;
use App\Models\Student;
use App\Models\Withdraw;
use App\Traits\General;
use App\Traits\SendNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Session;
use Redirect;
use Stripe;
use Razorpay\Api\Api;
use Exception;
use DB;


class CartManagementController extends Controller
{
    use General, SendNotification;

    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function cartList()
    {
        $data['pageTitle'] = 'Cart';

        $carts = CartManagement::whereUserId(@Auth::user()->id)->get();

        foreach ($carts as $cart)
        {
            $cart = CartManagement::find($cart->id);

            // Start:: Promotion Course Check or not
            $course = Course::find($cart->course_id);
            if ($course)
            {
                $startDate = date('d-m-Y H:i:s', strtotime(@$course->promotionCourse->promotion->start_date));
                $endDate = date('d-m-Y H:i:s', strtotime(@$course->promotionCourse->promotion->end_date));
                $percentage = @$course->promotionCourse->promotion->percentage;
                $promotion_discount_price = number_format($course->price - (($course->price * $percentage) / 100), 2);

                if(now()->gt($startDate) && now()->lt($endDate))
                {
                    $cart->promotion_id = @$course->promotionCourse->promotion->id;
                    $cart->price = $promotion_discount_price;
                } else {
                    $cart->price = $cart->main_price;
                }
            } else {
                $cart->price = $cart->main_price;
            }
            // End:: Promotion Course Check or not

            $cart->coupon_id = null;
            $cart->discount = 0;
            $cart->save();
        }

        $data['carts'] = CartManagement::whereUserId(@Auth::user()->id)->get();

        return view('frontend.student.cart.cart-list', $data);
    }


    public function applyCoupon(Request $request)
    {
        if (!Auth::check()) {
            $response['msg'] = "You need to login first!";
            $response['status'] = 401;
            return response()->json($response);
        }

        if (!$request->coupon_code) {
            $response['msg'] = "Enter coupon code!";
            $response['status'] = 404;
            return response()->json($response);
        }


        if ($request->id) {
            $cart = CartManagement::find($request->id);
            if (!$cart) {
                $response['msg'] = "Cart item not found!";
                $response['status'] = 404;
                return response()->json($response);
            }

            $coupon = Coupon::where('coupon_code_name', $request->coupon_code)->where('start_date', '<=', Carbon::now()->format('Y-m-d'))->where('end_date', '>=', Carbon::now()->format('Y-m-d'))->first();

            if ($coupon)
            {
                if ($cart->price < $coupon->minimum_amount)
                {
                    $response['msg'] = "Minimum " . get_currency_code() .  $coupon->minimum_amount . " need to buy for use this coupon!";
                    $response['status'] = 402;
                    return response()->json($response);
                }

            }
            if (!$coupon) {
                $response['msg'] = "Invalid coupon code!";
                $response['status'] = 404;
                return response()->json($response);
            }


            if (CartManagement::whereUserId(@Auth::user()->id)->whereCouponId($coupon->id)->count() > 0) {
                $response['msg'] = "You've already used this coupon!";
                $response['status'] = 402;
                return response()->json($response);
            }

            $discount_price = ($cart->price * $coupon->percentage)/100;

            if ($coupon->coupon_type == 1)
            {
                $cart->price = round($cart->price - $discount_price);
                $cart->discount = $discount_price;
                $cart->coupon_id = $coupon->id;
                $cart->save();

                $carts = CartManagement::whereUserId(@Auth::user()->id)->get();
                $response['msg'] = "Coupon Applied";
                $response['price'] = $cart->price;
                $response['discount'] = $cart->discount;
                $response['total'] = get_number_format($carts->sum('price'));
                $response['platform_charge'] = get_platform_charge($carts->sum('price'));
                $response['grand_total'] = get_number_format($carts->sum('price') + get_platform_charge($carts->sum('price')));
                $response['status'] = 200;
                return response()->json($response);

            } elseif ($coupon->coupon_type == 2)
            {
                if ($cart->course)
                {
                    $user_id = $cart->course->user_id;
                } else {
                    $user_id = $cart->product->user_id;
                }

                $couponInstructor = CouponInstructor::where('coupon_id', $coupon->id)->where('user_id', $user_id)->orderBy('id', 'desc')->first();
                if ($couponInstructor) {

                    $cart->price = round($cart->price - $discount_price);
                    $cart->discount = $discount_price;
                    $cart->coupon_id = $coupon->id;
                    $cart->save();

                    $carts = CartManagement::whereUserId(@Auth::user()->id)->get();
                    $response['msg'] = "Coupon Applied";
                    $response['price'] = $cart->price;
                    $response['discount'] = $cart->discount;
                    $response['total'] = get_number_format($carts->sum('price'));
                    $response['platform_charge'] = get_platform_charge($carts->sum('price'));
                    $response['grand_total'] = get_number_format($carts->sum('price') + get_platform_charge($carts->sum('price')));
                    $response['status'] = 200;
                    return response()->json($response);

                } else {
                    $response['msg'] = "Invalid coupon code!";
                    $response['status'] = 404;
                    return response()->json($response);
                }

            } elseif ($coupon->coupon_type == 3)
            {
                $couponCourse = CouponCourse::where('coupon_id', $coupon->id)->where('course_id', $cart->course_id)->orderBy('id', 'desc')->first();
                if($couponCourse) {

                    $cart->price = round($cart->price - $discount_price);
                    $cart->discount = $discount_price;
                    $cart->coupon_id = $coupon->id;
                    $cart->save();

                    $carts = CartManagement::whereUserId(@Auth::user()->id)->get();
                    $response['msg'] = "Coupon Applied";
                    $response['price'] = $cart->price;
                    $response['discount'] = $cart->discount;
                    $response['total'] = get_number_format($carts->sum('price'));
                    $response['platform_charge'] = get_platform_charge($carts->sum('price'));
                    $response['grand_total'] = get_number_format($carts->sum('price') + get_platform_charge($carts->sum('price')));
                    $response['status'] = 200;
                    return response()->json($response);

                } else {
                    $response['msg'] = "Invalid coupon code!";
                    $response['status'] = 404;
                    return response()->json($response);
                }

            } else {
                $response['msg'] = "Invalid coupon code!";
                $response['status'] = 404;
                return response()->json($response);
            }

        } else {
            $response['msg'] = "Cart item not found!";
            $response['status'] = 404;
            return response()->json($response);
        }
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            $response['msg'] = "You need to login first!";
            $response['status'] = 401;
            return response()->json($response);
        }

        if ($request->course_id) {
            $courseOrderExits = Order_item::whereCourseId($request->course_id)->whereUserId(Auth::user()->id)->first();

            if ($courseOrderExits) {
                $order = Order::find($courseOrderExits->order_id);
                if ($order)
                {
                    if ($order->payment_status == 'due')
                    {
                        Order_item::whereOrderId($courseOrderExits->order_id)->get()->map(function ($q) {
                            $q->delete();
                        });
                        $order->delete();
                    } else {
                        $response['msg'] = "You've already purchased the course!";
                        $response['status'] = 402;
                        return response()->json($response);
                    }
                }
            }

            $ownCourseCheck = Course::whereUserId(Auth::user()->id)->where('id', $request->course_id)->first();

            if ($ownCourseCheck) {
                $response['msg'] = "This is your course. No need to add to cart.";
                $response['status'] = 402;
                return response()->json($response);
            }

            $courseExits = Course::find($request->course_id);
            if (!$courseExits) {
                $response['msg'] = "Course not found!";
                $response['status'] = 404;
                return response()->json($response);
            }
        }

        if ($request->product_id) {
            $productExits = Product::find($request->product_id);
            if (!$productExits) {
                $response['msg'] = "Product not found!";
                $response['status'] = 404;
                return response()->json($response);
            }
        }

        $cartExists = CartManagement::whereUserId(Auth::user()->id)->whereCourseId($request->course_id)->orWhere($request->product_id)->first();
        if ($cartExists) {
            $response['msg'] = "Already added to cart!";
            $response['status'] = 409;
            return response()->json($response);
        }

        if ($courseExits->learner_accessibility == 'free')
        {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->order_number = rand(100000, 999999);
            $order->payment_status = 'free';
            $order->save();

            $order_item = new Order_item();
            $order_item->order_id = $order->id;
            $order_item->user_id = Auth::user()->id;
            $order_item->course_id = $courseExits->id;
            $order_item->owner_user_id = $courseExits->user_id ?? null;
            $order_item->unit_price = 0;
            $order_item->admin_commission = 0;
            $order_item->owner_balance = 0;
            $order_item->sell_commission = 0;
            $order_item->save();

            $response['msg'] = "Free Course added to your my learning list!";
            $response['status'] = 200;
            return response()->json($response);
        }

        $cart = new CartManagement();
        $cart->user_id = Auth::user()->id;
        $cart->course_id = $request->course_id;
        $cart->product_id = $request->product_id;
        $cart->main_price = $courseExits->price;

        if ($request->course_id) {
            $cart->price = $courseExits->price;
        } elseif ($request->product_id) {
            $cart->price = $productExits->price;
        }

        $cart->save();

        $response['quantity'] = CartManagement::whereUserId(Auth::user()->id)->count();
        $response['msg'] = "Added to cart";
        $response['status'] = 200;

        return response()->json($response);
    }

    public function goToCheckout(Request $request)
    {
        if ($request->has('proceed_to_checkout'))
        {
            return redirect(route('student.checkout'));

        } elseif ($request->has('pay_from_lmszai_wallet'))
        {
            $carts = CartManagement::whereUserId(@Auth::user()->id)->get();

            if ($carts->sum('price') > instructor_available_balance())
            {
                $this->showToastrMessage('warning', 'Insufficient balance');
                return redirect()->back();
            } else {

               $order =  $this->placeOrder('buy');
                $order->payment_status = 'paid';
                $order->save();

                /** ====== Send notification =========*/
                $text = "New student enrolled";
                $target_url = route('instructor.all-student');
                foreach ($order->items as $item)
                {
                    if ($item->course)
                    {
                        $this->send($text, 2, $target_url, $item->course->user_id);
                    }
                }

                $text = "Course has been sold";
                $this->send($text, 1, null, null);

                /** ====== Send notification =========*/

                $withdrow = new Withdraw();
                $withdrow->transection_id = rand(1000000, 9999999);;
                $withdrow->amount = $carts->sum('price');
                $withdrow->payment_method = 'buy';
                $withdrow->status = 1;
                $withdrow->save();


                $this->showToastrMessage('success', 'Payment has been completed');
                return redirect()->route('student.thank-you');
            }

        }  elseif ($request->has('cancel_order')) {
            CartManagement::whereUserId(@Auth::user()->id)->delete();
            $this->showToastrMessage('warming', 'Order has been cancel');
            return redirect(url('/'));

        } else {
            abort(404);
        }
    }

    public function cartDelete($id)
    {
        $cart = CartManagement::findOrFail($id);
        $cart->delete();
        $this->showToastrMessage('success', 'Removed from cart list!');
        return redirect()->back();
    }

    public function checkout()
    {
        $data['pageTitle'] = "Checkout";
        $data['carts'] = CartManagement::whereUserId(@Auth::user()->id)->get();
        $data['student'] = auth::user()->student;
        $data['countries'] = Country::orderBy('country_name', 'asc')->get();

        if (old('country_id'))
        {
            $data['states'] = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();
        }

        if (old('state_id'))
        {
            $data['cities'] = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();
        }

        $razorpay_grand_total_with_conversion_rate = ($data['carts']->sum('price') + get_platform_charge($data['carts']->sum('price'))) * (get_option('razorpay_conversion_rate') ? get_option('razorpay_conversion_rate') : 0);
        $data['razorpay_grand_total_with_conversion_rate'] =  (float)preg_replace("/[^0-9.]+/", "", number_format($razorpay_grand_total_with_conversion_rate, 2));

        $sslcommerz_grand_total_with_conversion_rate = ($data['carts']->sum('price') + get_platform_charge($data['carts']->sum('price'))) * (get_option('sslcommerz_conversion_rate') ? get_option('sslcommerz_conversion_rate') : 0);
        $data['sslcommerz_grand_total_with_conversion_rate'] =  (float)preg_replace("/[^0-9.]+/", "", number_format($sslcommerz_grand_total_with_conversion_rate, 2));

        return view('frontend.student.cart.checkout', $data);
    }

    public function razorpay_payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        if (empty(env('RAZORPAY_KEY')) && empty(env('RAZORPAY_SECRET')))
        {
            $this->showToastrMessage('error', 'Razorpay payment gateway off!');
            return redirect()->back();
        }

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        $order = $this->placeOrder($request->payment_method);
        $order->payment_status = 'paid';
        $order->payment_method = 'razorpay';

        $payment_currency = get_option('razorpay_currency');
        $conversion_rate = get_option('razorpay_conversion_rate') ? get_option('razorpay_conversion_rate') : 0;

        $order->payment_currency = $payment_currency;
        $order->conversion_rate = $conversion_rate;
        $order->grand_total_with_conversation_rate = ($order->sub_total + $order->platform_charge) * $conversion_rate;
        $order->save();

        /** ====== Send notification =========*/
        $text = "New student enrolled";
        $target_url = route('instructor.all-student');
        foreach ($order->items as $item)
        {
            if ($item->course)
            {
                $this->send($text, 2, $target_url, $item->course->user_id);
            }
        }

        $text = "Course has been sold";
        $this->send($text, 1, null, null);

        /** ====== Send notification =========*/

        $this->showToastrMessage('success', 'Payment has been completed');
        return redirect()->route('student.thank-you');
    }

    public function pay(Request $request)
    {
        if (is_null($request->payment_method))
        {
            $this->showToastrMessage('warning', 'Please Select Payment Method');
            return redirect()->back();
        }

        if ($request->payment_method == 'paypal')
        {
            if (empty(env('paypal_currency')) && empty(env('paypal_conversion_rate')) && empty(env('PAYPAL_CLIENT_ID')) && empty(env('PAYPAL_SECRET')) && empty(env('PAYPAL_MODE')))
            {
                $this->showToastrMessage('error', 'Paypal payment gateway off!');
                return redirect()->back();
            }
        }

       $order = $this->placeOrder($request->payment_method);
       /** order billing address */

        if (auth::user()->student)
        {
            $student = Student::find(auth::user()->student->id);
            $student->fill($request->all());
            $student->save();
        }


        if ($request->payment_method == 'paypal')
        {
            $paypal_grand_total_with_conversion_rate = $order->grand_total * (get_option('paypal_conversion_rate') ? get_option('paypal_conversion_rate') : 0);
            $paypal_grand_total_with_conversion_rate =  (float)preg_replace("/[^0-9.]+/", "", number_format($paypal_grand_total_with_conversion_rate, 2));

            $currency = get_option('paypal_currency');
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();
            $item_1->setName('Payment for purchase')/** item name **/
            ->setCurrency($currency)
                ->setQuantity(1)
                ->setPrice($paypal_grand_total_with_conversion_rate);
            /** unit price **/

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency($currency)
                ->setTotal($paypal_grand_total_with_conversion_rate);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Payment for purchase');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(route('student.paypalPaymentStatus'))/** Specify return URL **/
            ->setCancelUrl(route('student.paypalPaymentStatus'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
            try {

                $payment->create($this->_api_context);

            } catch (\PayPal\Exception\PPConnectionException $ex) {

                if (\Config::get('app.debug')) {

                    \Session::put('error', 'Connection timeout');
                    return redirect()->back();

                } else {

                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return redirect()->back();

                }

            }

            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }
            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());
            Session::put('order_uuid', $order->uuid);
            if (isset($redirect_url)) {
                /** redirect to paypal **/
                return Redirect::away($redirect_url);

            }

            \Session::put('error', 'Unknown error occurred');
            return redirect()->back();

        } else {
            try {
                $stripe_grand_total_with_conversion_rate = $order->grand_total * (get_option('stripe_conversion_rate') ? get_option('stripe_conversion_rate') : 0);
                $stripe_grand_total_with_conversion_rate =  (float)preg_replace("/[^0-9.]+/", "", number_format($stripe_grand_total_with_conversion_rate, 2));

                $stripeToken = $request->stripeToken;
                Stripe\Stripe::setApiKey(get_option('STRIPE_SECRET_KEY'));
                $charge = Stripe\Charge::create([
                    "amount" => ($stripe_grand_total_with_conversion_rate * 100),
                    "currency" => get_option('stripe_currency'),
                    "source" => $stripeToken,
                    "description" => 'Payment for purchase'
                ]);

                if ($charge->status == 'succeeded') {
                    $order->payment_status = 'paid';
                    $order->payment_method = 'stripe';
                    $order->save();

                    /** ====== Send notification =========*/
                    $text = "New student enrolled";
                    $target_url = route('instructor.all-student');
                    foreach ($order->items as $item)
                    {
                        if ($item->course)
                        {
                            $this->send($text, 2, $target_url, $item->course->user_id);
                        }
                    }

                    $text = "Course has been sold";
                    $this->send($text, 1, null, null);

                    /** ====== Send notification =========*/

                    $this->showToastrMessage('success', 'Payment has been completed');
                    return redirect()->route('student.thank-you');
                }
            } catch (\Stripe\Error\Card $e) {
                // The card has been declined
                $this->showToastrMessage('error', 'Payment has been declined');
                return redirect(url('/'));
            }
        }
    }

    public function paypalPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $order_uuid = Session::get('order_uuid');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('order_uuid');
        if (empty($request->PayerID) || empty($request->token)) {
            $this->showToastrMessage('error', 'Payment has been declined');
            return redirect(url('/'));
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);


        if ($result->getState() == 'approved') {
            $transactions = $result->getTransactions();
            $order = Order::whereUuid($order_uuid)->firstOrFail();;
            $order->payment_status = 'paid';
            $order->payment_method = 'paypal';
            $order->save();

            /** ====== Send notification =========*/
            $text = "New student enrolled";
            $target_url = route('instructor.all-student');
            foreach ($order->items as $item)
            {
                if ($item->course)
                {
                    $this->send($text, 2, $target_url, $item->course->user_id);
                }
            }

            $text = "Course has been sold";
            $this->send($text, 1, null, null);

            /** ====== Send notification =========*/

            $this->showToastrMessage('success', 'Payment has been completed');
            return redirect()->route('student.thank-you');

        }

        $this->showToastrMessage('error', 'Payment has been declined');
        return redirect(url('/'));
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $order = $this->placeOrder($request->payment_method);

        //Start:: Conversion rate
        $sslcommerz_grand_total_with_conversion_rate = $order->grand_total * (get_option('sslcommerz_conversion_rate') ? get_option('sslcommerz_conversion_rate') : 0);
        $sslcommerz_grand_total_with_conversion_rate =  (float)preg_replace("/[^0-9.]+/", "", number_format($sslcommerz_grand_total_with_conversion_rate, 2));
        //End:: Conversion rate

        $student = $order->user->student;
        $post_data = array();
        $post_data['total_amount'] = $sslcommerz_grand_total_with_conversion_rate; # You cant not pay less than 10
        $post_data['currency'] = get_option('sslcommerz_currency');
        $post_data['tran_id'] = $order->uuid; // tran_id must be unique
        $post_data['product_category'] = "Payment for purchase";
        $post_data['cus_name'] = $order->user ? $order->user->name : 'Student' ;

        # CUSTOMER INFORMATION

        $post_data['cus_email'] =  $student->name;
        $post_data['cus_add1'] = $student->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] =  $student->phone_number;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = get_option('app_name') ?? 'LMS store';
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Course Buy";

        $post_data['product_profile'] = "digital-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $order = Order::whereUuid($request->input('tran_id'))->first();
        $order->payment_status = 'paid';
        $order->payment_method = 'sslcommerz';

        $payment_currency = get_option('sslcommerz_currency');
        $conversion_rate = get_option('sslcommerz_conversion_rate') ? get_option('sslcommerz_conversion_rate') : 0;

        $order->payment_currency = $payment_currency;
        $order->conversion_rate = $conversion_rate;
        $order->grand_total_with_conversation_rate = ($order->sub_total + $order->platform_charge) * $conversion_rate;
        $order->save();

        /** ====== Send notification =========*/
        $text = "New student enrolled";
        $target_url = route('instructor.all-student');
        foreach ($order->items as $item)
        {
            if ($item->course)
            {
                $this->send($text, 2, $target_url, $item->course->user_id);
            }
        }

        $text = "Course has been sold";
        $this->send($text, 1, null, null);

        /** ====== Send notification =========*/

        $this->showToastrMessage('success', 'Payment has been completed');
        return redirect()->route('student.thank-you');
    }

    public function fail(Request $request)
    {
        $order = Order::whereUuid($request->input('tran_id'))->first();
        $order->payment_method = 'sslcommerz';
        $order->save();

        $this->showToastrMessage('success', 'Payment has been completed');
        return redirect(route('student.my-learning'));

    }

    public function cancel(Request $request)
    {
        $order = Order::whereUuid($request->input('tran_id'))->first();
        $order->payment_method = 'sslcommerz';
        $order->save();

        $this->showToastrMessage('success', 'Payment has been completed');
        return redirect(route('student.my-learning'));
    }

    public function ipn(Request $request)
    {
        $order = Order::whereUuid($request->input('tran_id'))->first();
        $order->payment_method = 'sslcommerz';
        $order->save();

        $this->showToastrMessage('success', 'Payment has been completed');
        return redirect(route('student.my-learning'));
    }


    private function placeOrder($payment_method)
    {
        $carts = CartManagement::whereUserId(@Auth::user()->id)->get();
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_number = rand(100000, 999999);
        $order->sub_total = $carts->sum('price');
        $order->discount = $carts->sum('discount');
        $order->platform_charge = get_platform_charge($carts->sum('price'));
        $order->current_currency = get_currency_code();
        $order->grand_total = $order->sub_total + $order->platform_charge;
        $order->payment_method = $payment_method;

        $payment_currency = '';
        $conversion_rate  = '';

        if ($payment_method == 'paypal') {
            $payment_currency = get_option('paypal_currency');
            $conversion_rate = get_option('paypal_conversion_rate') ? get_option('paypal_conversion_rate') : 0;
        } elseif ($payment_method == 'stripe'){
            $payment_currency = get_option('stripe_currency');
            $conversion_rate = get_option('stripe_conversion_rate') ? get_option('stripe_conversion_rate') : 0;
        }

        $order->payment_currency = $payment_currency;
        $order->conversion_rate = $conversion_rate;
        if ($conversion_rate) {
            $order->grand_total_with_conversation_rate = ($order->sub_total + $order->platform_charge) * $conversion_rate;
        }

        $order->save();

        foreach ($carts as $cart)
        {
            $order_item = new Order_item();
            $order_item->order_id = $order->id;
            $order_item->user_id = Auth::user()->id;
            if ($cart->course_id)
            {
                $order_item->course_id = $cart->course_id;
                $order_item->owner_user_id = $cart->course ? $cart->course->user_id : null;
            }

            if ($cart->product_id)
            {
                $order_item->product_id = $cart->product_id;
                $order_item->owner_user_id = $cart->product ? $cart->product->user_id : null;
                $order_item->type = 2;
            }
            $order_item->unit_price = $cart->price;
            if (get_option('sell_commission'))
            {
                $order_item->admin_commission = admin_sell_commission($cart->price);
                $order_item->owner_balance = $cart->price - admin_sell_commission($cart->price);
                $order_item->sell_commission = get_option('sell_commission');
            } else {
                $order_item->owner_balance = $cart->price;
            }

            $order_item->save();
        }
        CartManagement::whereUserId(@Auth::user()->id)->delete();
        return $order;
    }
}
