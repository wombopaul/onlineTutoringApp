<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\MainIndexController;
use App\Http\Controllers\Frontend\RegistrationController;
use App\Http\Controllers\Frontend\SupportTicketController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('sign-up', [RegistrationController::class, 'signUp'])->name('sign-up');
    Route::post('store-sign-up', [RegistrationController::class, 'storeSignUp'])->name('store.sign-up');
});

Route::get('forget-password', [LoginController::class, 'forgetPassword'])->name('forget-password');
Route::post('forget-password', [LoginController::class, 'forgetPasswordEmail'])->name('forget-password.email');
Route::get('reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [LoginController::class, 'resetPasswordCheck'])->name('reset-password.check');

Route::get('user/email/verify/{token}', [RegistrationController::class, 'emailVerification'])->name('user.email.verification');


Route::get('/', [MainIndexController::class, 'index'])->name('main.index');

Route::get('about-us', [MainIndexController::class, 'aboutUs'])->name('about');
Route::get('contact-us', [MainIndexController::class, 'contactUs'])->name('contact');
Route::post('contact-store', [MainIndexController::class, 'contactUsStore'])->name('contact.store');
Route::get('faq', [MainIndexController::class, 'faq'])->name('faq');
Route::get('instructor/{id}/{slug}', [MainIndexController::class, 'instructorDetails'])->name('instructorDetails');
Route::post('instructor-course-paginate/{id}', [MainIndexController::class, 'instructorCoursePaginate'])->name('instructorCoursePaginate');

Route::get('all-instructor', [MainIndexController::class, 'allInstructor'])->name('allInstructor');

// Start:: Course
Route::get('courses', [CourseController::class, 'allCourses'])->name('courses');
Route::get('course-details/{slug}', [CourseController::class, 'courseDetails'])->name('course-details');

Route::get('category/courses/{slug}', [CourseController::class, 'categoryCourses'])->name('category-courses');
Route::get('subcategory/courses/{slug}', [CourseController::class, 'subCategoryCourses'])->name('subcategory-courses');

Route::get('get-sub-category-courses/fetch-data', [CourseController::class, 'paginationFetchData'])->name('course.fetch-data');
Route::get('get-filter-courses', [CourseController::class, 'getFilterCourse'])->name('getFilterCourse');
Route::post('review-paginate/{courseId}', [CourseController::class, 'reviewPaginate'])->name('frontend.reviewPaginate');

Route::get('search-course-list', [CourseController::class, 'searchCourseList'])->name('search-course.list');
// End:: Course

// Start:: Blog & Comment
Route::get('blogs', [BlogController::class, 'blogAll'])->name('blogs');
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');

Route::get('category-blogs/{slug}', [BlogController::class, 'categoryBlogs'])->name('categoryBlogs');

Route::post('blog-comment', [BlogController::class, 'blogCommentStore'])->name('blog-comment.store');
Route::post('blog-comment-reply', [BlogController::class, 'blogCommentReplyStore'])->name('blog-comment-reply.store');

Route::get('search-blog-list', [BlogController::class, 'searchBlogList'])->name('search-blog.list');
// End:: Blog & Comment


Route::get('privacy-policy', [MainIndexController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('cookie-policy', [MainIndexController::class, 'cookiePolicy'])->name('cookie-policy');

Route::get('support-ticket-faq',[SupportTicketController::class, 'supportTicketFAQ'])->name('support-ticket-faq');


// Google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Twitter login
Route::get('login/twitter', [LoginController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [LoginController::class, 'handleTwitterCallback']);

Route::get('page/{slug?}',[PageController::class, 'pageShow'])->name('page');

