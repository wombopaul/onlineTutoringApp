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
                                <h2>Privacy Policy</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item">Policy</li>
                                    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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
                            <h2>Privacy Policy</h2>
                        </div>
                        <form action="{{route('admin.privacy-policy.store')}}" method="post" class="form-horizontal">
                            @csrf

                            <div class="input__group mb-25">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="editor-text">{{ @$policy->description ?? old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('description') }}</span>
                                @endif

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary" type="submit">Save</button>
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

@push('script')
    <script src="{{asset('admin/js/custom/slug.js')}}"></script>
    <script src="{{asset('admin/js/ckeditor.js')}}"></script>
    <script src="{{asset('admin/js/custom/form-editor.js')}}"></script>
@endpush

