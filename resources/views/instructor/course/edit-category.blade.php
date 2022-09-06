@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.upload_course')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('instructor.course') }}">{{__('app.my_courses')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.upload_course')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part instructor-upload-course-box-part">
        <div class="instructor-upload-course-box">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar" class="upload-course-item-block d-flex align-items-center justify-content-center">
                                <li class="active" id="account"><strong>Course Overview</strong></li>
                                <li  id="personal"><strong>Upload Video</strong></li>
                                <li id="confirm"><strong>Submit process</strong></li>
                            </ul>

                            <div class="upload-course-step-item upload-course-overview-step-item">
                                <!-- Upload Course Overview-2 start -->
                                <form method="POST" action="{{route('course.update.category', [$course->uuid])}}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div id="upload-course-overview-2">

                                    <div class="upload-course-item-block course-overview-step1 radius-8">
                                        <div class="upload-course-item-block-title mb-3">
                                            <h6 class="font-20">Category</h6>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Course category
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <select name="category_id" id="category_id" class="form-select" required>
                                                    <option value="">Select category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(old('category_id')) {{old('category_id') == $category->id ? 'selected' : '' }} @else {{ $course->category_id == $category->id ? 'selected' : '' }} @endif >{{$category->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('category_id'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('category_id') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Course sub category
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                                                    <option value="">Select sub category</option>
                                                    @foreach($subcategories as $subcategory)
                                                        <option value="{{$subcategory->id}}" {{$subcategory->id == $course->subcategory_id ? 'selected' : '' }} >{{$subcategory->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('subcategory_id'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('subcategory_id') }}</span>
                                                @endif

                                            </div>
                                        </div> --}}
                                        {{-- <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Tags
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                                                !
                                                                            </span>
                                                </label>
                                                <select name="tag[]"  class="select2" multiple>
                                                    @foreach($tags as $tag)
                                                        <option value="{{$tag->id}}" @if(in_array($tag->id, $selected_tags)) selected @endif>{{$tag->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('tag'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('tag') }}</span>
                                                @endif

                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="upload-course-item-block course-overview-step1 radius-8">
                                        <div class="upload-course-item-block-title mb-3">
                                            <h6 class="font-20">Learner's Accessibility & others</h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Learner's Accessibility
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <select name="learner_accessibility" class="form-select learner_accessibility" required>
                                                    <option value=""  >Select Option</option>
                                                    <option value="paid" @if(old('learner_accessibility')) {{old('learner_accessibility') == 'paid' ? 'selected' : '' }} @else {{ $course->learner_accessibility == 'paid' ? 'selected' : '' }} @endif >{{__('app.paid')}}</option>
                                                    <option value="free" @if(old('learner_accessibility')) {{old('learner_accessibility') == 'free' ? 'selected' : '' }} @else {{ $course->learner_accessibility == 'free' ? 'selected' : '' }} @endif >{{__('app.free')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row priceDiv">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Course price
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <input type="number" name="price" value="{{$course->price == '0' ? '' : $course->price}}" min="1"  maxlength="11" class="form-control price" placeholder="price" required>

                                                @if ($errors->has('price'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('price') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Language
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <select name="course_language_id" id="course_language_id" class="form-select" required>
                                                    <option value="">Select Language</option>
                                                    @foreach($course_languages as $course_language)
                                                        <option value="{{$course_language->id}}" @if(old('course_language_id')) {{old('course_language_id') == $course_language->id ? 'selected' : '' }} @else {{ $course->course_language_id == $course_language->id ? 'selected' : '' }} @endif >{{$course_language->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('course_language_id'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('course_language_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Difficulty Level
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                <select name="difficulty_level_id" id="difficulty_level_id" class="form-select" required>
                                                    <option value="">Select Difficulty Level</option>
                                                    @foreach($difficulty_levels as $difficulty_level)
                                                        <option value="{{$difficulty_level->id}}" @if(old('difficulty_level_id')) {{old('difficulty_level_id') == $difficulty_level->id ? 'selected' : '' }} @else {{ $course->difficulty_level_id == $difficulty_level->id ? 'selected' : '' }} @endif >{{$difficulty_level->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('difficulty_level_id'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('difficulty_level_id') }}</span>
                                                @endif

                                            </div>
                                        </div> --}}
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Course thumbnail
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                                </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="upload-img-box mt-3 height-200">
                                                    @if($course->image)
                                                        <img src="{{getImageFile($course->image)}}">
                                                    @else
                                                        <img src="">
                                                    @endif
                                                    <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)" @if(!$course->image) required @endif>
                                                    <div class="upload-img-box-icon">
                                                        <i class="fa fa-camera"></i>
                                                        <p class="m-0">{{__('app.image')}}</p>
                                                    </div>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <p class="font-14 color-gray">Preferable image format & size: 575px X 450px (1MB)</p>
                                                <p class="font-14 color-gray">Preferable filetype: jpg, jpeg, png</p>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">Course Introduction Video
                                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"  data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                                        !
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-12 mb-30">
                                                <input type="file" name="video" id="video" accept="video/mp4" class="form-control" @if(!$course->video) required @endif>
                                            </div>
                                            @if($course->video)
                                            <div class="col-md-12 mb-30">
                                                <video class="uploaded-course-edit-video" controls>
                                                    <source src="{{ getVideoFile($course->video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                            @endif

                                            @if ($errors->has('video'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('video') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <a href="{{route('instructor.course.edit', [$course->uuid, 'step=overview'])}}" class="theme-btn theme-button3 show-last-phase-back-btn">{{__('app.back')}}</a>
                                    <button type="submit" class="theme-btn default-hover-btn theme-button1">{{__('app.save_and_continue')}}</button>

                                </div>
                                </form>
                                <!-- Upload Course Overview-2 end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('common/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom/img-view.css')}}">
@endpush

@push('script')

    <script src="{{asset('common/js/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/img-view.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/upload-course.js')}}"></script>
@endpush
