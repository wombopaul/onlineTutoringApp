@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.edit_certificate')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('instructor.certificate.index') }}">{{__('app.manage_certificate')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.edit_certificate')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-create-certificate-page only-frontend-create-certificate-page">

            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>{{__('app.edit_certificate')}}</h6>
            </div>

            <div class="row create-certificate-row">
                <div class="col-12 col-md-12 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="create-certificate-sidebar">
                        <form method="POST" action="{{route('instructor.certificate.update', [$certificate_by_instructor->uuid])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item course-sidebar-accordion-item">
                                    <h2 class="accordion-header course-sidebar-title mb-2" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            Certificate Title
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="certificate-inner-box">
                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Title</div>
                                                        <input type="text" name="title" value="{{$certificate_by_instructor->title}}" class="form-control" placeholder="Certificate Title">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Position Y</div>
                                                        <input type="number" name="title_y_position" value="{{$certificate_by_instructor->title_y_position}}" min="0" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Font Size</div>
                                                        <input type="number" name="title_font_size" value="{{$certificate_by_instructor->title_font_size}}" min="1" class="form-control" placeholder="30">
                                                    </div>
                                                    <div class="col-md-6 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Font Color</div>
                                                        <span class="color-picker">
                                                                <label for="colorPicker" class="mb-0">
                                                                    <input type="color" name="title_font_color" value="{{$certificate_by_instructor->title_font_color}}" id="colorPicker">
                                                                </label>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item course-sidebar-accordion-item">
                                    <h2 class="accordion-header course-sidebar-title mb-2" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            Body
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <div class="certificate-inner-box">
                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Body</div>
                                                        <textarea name="body" id="" cols="30" rows="6" class="form-control">{{$certificate_by_instructor->body}}</textarea>

                                                        <div class="certificate-body-textarea-btns mt-1">
                                                            <button class="color-hover">[name]</button>
                                                            <button class="color-hover">[course]</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Position Y</div>
                                                        <input type="number" name="body_y_position" value="{{$certificate_by_instructor->body_y_position}}" min="1" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Font Size</div>
                                                        <input type="number" name="body_font_size" value="{{$certificate_by_instructor->body_font_size}}" min="1" class="form-control" placeholder="30">
                                                    </div>
                                                    <div class="col-md-6 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Font Color</div>
                                                        <span class="color-picker">
                                                                <label for="colorPicker1" class="mb-0">
                                                                    <input type="color" name="body_font_color" value="{{$certificate_by_instructor->body_font_color}}" id="colorPicker1">
                                                                </label>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item course-sidebar-accordion-item">
                                    <h2 class="accordion-header course-sidebar-title mb-2" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Your Signature
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            <div class="certificate-inner-box">
                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Signature (Max Limit:500KB)</div>
                                                        <div class="create-certificate-browse-file form-control mb-2">
                                                            <div>
                                                                <input type="file" name="signature" accept="image/*" class="form-control" title="Browse Image File">
                                                            </div>
                                                        </div>
                                                        <div class="recomended-size-for-img font-12">(Recommend Size 120x60 px)</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-15">
                                                        <div class="label-text-title color-heading font-16 mb-1">Position Y</div>
                                                        <input type="text" name="role_2_y_position" value="{{$certificate_by_instructor->role_2_y_position}}" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="theme-btn theme-button1 default-hover-btn mt-30">Save Certificate</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 col-xl-7 col-xxl-8">
                    <div class="course-watch-certificate-img sticky-top">
                        <iframe src="{{ asset($certificate_by_instructor->path) }}" class="certificate-pdf-iframe"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/for-certificate.css')}}">
    <link rel="preload" href="{{asset('frontend/assets/fonts/mongolian_baiti/MongolianBaiti.woff2')}}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{asset('frontend/assets/fonts/mongolian_baiti/MongolianBaiti.woff2')}}" as="font" type="font/woff2" crossorigin>
@endpush

@push('script')
    <script src="{{asset('frontend/assets/js/color.js')}}"></script>
@endpush
