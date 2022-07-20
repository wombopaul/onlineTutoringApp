@extends('layouts.admin')

@section('content')
    <!-- Page content area start -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb__content">
                        <div class="breadcrumb__content__left">
                            <div class="breadcrumb__title">
                                <h2>Add Instructor</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Instructor</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>Add Instructor</h2>
                        </div>
                        <form action="{{route('instructor.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="input__group mb-25">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" value="{{old('first_name')}}" placeholder="first name" class="form-control" required>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="last name" class="form-control" required>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{old('email')}}" placeholder="email" class="form-control" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" value="{{old('password')}}" placeholder="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Professional Title <span class="text-danger">*</span></label>
                                <input type="text" name="professional_title" value="{{old('professional_title')}}" placeholder="professional title" class="form-control" required>
                                @if ($errors->has('professional_title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" value="{{old('phone_number')}}" placeholder="phone number" class="form-control" required>
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>About Instructor <span class="text-danger">*</span></label>
                                <textarea name="about_me" id="" cols="15" rows="5" required>{{ old('about_me') }}</textarea>
                                @if ($errors->has('about_me'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="upload-img-box mb-25">
                                        <img src="">
                                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('app.image')}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                @endif
                                <p>Accepted Image Files: JPEG, JPG, PNG <br> Recommend Size: 300 x 228 (1MB)</p>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right">
                                    @saveWithAnotherButton
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content area end -->
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
@endpush
