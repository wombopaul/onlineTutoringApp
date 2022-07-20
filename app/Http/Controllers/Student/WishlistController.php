<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Wishlist;
use App\Traits\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use General;

    public function wishlist()
    {
        $data['pageTitle'] = 'Wishlist';
        $data['wishlists'] = Wishlist::whereUserId(Auth::user()->id)->paginate();

        return view('frontend.student.wishlist.wishlist', $data);
    }

    public function addToWishlist(Request $request)
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
                        $response['status'] = 404;
                        return response()->json($response);
                    }
                }
            }

            $ownCourseCheck = Course::whereUserId(Auth::user()->id)->where('id', $request->course_id)->first();

            if ($ownCourseCheck) {
                $response['msg'] = "This is your course. No need to add to cart.";
                $response['status'] = 404;
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

        $wishListExists = WishList::whereUserId(Auth::user()->id)->whereCourseId($request->course_id)->orWhere($request->product_id)->first();
        if ($wishListExists) {
            $response['msg'] = "Already added to wishlist!";
            $response['status'] = 409;
            return response()->json($response);
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::user()->id;
        $wishlist->course_id = $request->course_id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        $response['quantity'] = Wishlist::whereUserId(Auth::user()->id)->count();
        $response['msg'] = "Added to wishlist";
        $response['status'] = 200;

        return response()->json($response);
    }

    public function wishlistDelete($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        $this->showToastrMessage('success', 'Removed from wishlist!');
        return redirect()->back();
    }
}
