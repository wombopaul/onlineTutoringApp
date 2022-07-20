@extends('frontend.layouts.app')

@section('content')
<!-- Page Header Start -->
<header class="page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="page-banner-content text-center">
                        <h3 class="page-banner-heading text-white pb-15">All instructor</h3>

                        <!-- Breadcrumb Start-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item font-14 active" aria-current="page">All instructor</li>
                            </ol>
                        </nav>
                        <!-- Breadcrumb End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Header End -->
<!-- Our Top Instructor Area Start -->
<section class="top-instructor-area section-t-space bg-white">
    <div class="container">
        <div class="row top-instructor-content-wrap">
            @forelse($userInstructors as $userInstructor)
            <!-- Single Instructor Item start-->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card instructor-item border-0">
                    <div class="instructor-img-wrap overflow-hidden"><a href="{{ route('instructorDetails', [$userInstructor->id, $userInstructor->name]) }}">
                            <img src="{{ getImageFile($userInstructor->image_path) }}" alt="instructor"></a></div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('instructorDetails', [$userInstructor->id, Str::slug($userInstructor->name)]) }}">{{ $userInstructor->name }}</a></h5>
                        <p class="card-text instructor-designation font-medium text-uppercase">{{ @$userInstructor->instructor->professional_title }}</p>
                        <div class="instructor-bottom d-flex align-items-start justify-content-between">
                            <div class="instructor-bottom-item font-14 font-medium"><img src="{{ asset('frontend/assets/img/icons-svg/rating.svg')}}" alt="star">
                                <?php
                                $average_rating = \App\Models\Course::where('user_id', $userInstructor->id)->avg('average_rating');
                                ?>
                                {{ number_format(@$average_rating, 1) }}</div>
                            <div class="instructor-bottom-item font-14">{{ @$userInstructor->students->count() }} {{ __('app.student') }}</div>
                            <div class="instructor-bottom-item font-14">{{ @$userInstructor->courses->count() }} {{ __('app.courses') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Instructor Item End-->
            @empty
                <div class="no-course-found text-center">
                    <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                    <h5 class="mt-3">No Instructor Found</h5>
                </div>
            @endforelse
        </div>
        <!-- Pagination Start -->
        @if(@$userInstructors->hasPages())
            {{ @$userInstructors->links('frontend.paginate.paginate') }}
        @endif
        <!-- Pagination End -->
    </div>
</section>
<!-- Our Top Instructor Area End -->

@endsection
