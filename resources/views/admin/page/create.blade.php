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
                                <h2>Add Page</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('page.index')}}">All Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Page</li>
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
                            <h2>Add Page</h2>
                        </div>
                        <form action="{{route('page.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="input__group mb-25">
                                <label>{{__('app.title')}} <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" placeholder="{{__('app.title')}}" class="form-control slugable"  onkeyup="slugable()" required>
                                @if ($errors->has('title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25 d-none" >
                                <label>{{__('app.slug')}} <span class="text-danger">*</span></label>
                                <input type="text" name="slug" value="{{old('slug')}}" placeholder="{{__('app.slug')}}" class="form-control slug" onkeyup="getMyself()" required>
                                @if ($errors->has('slug'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('slug') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="en_description" id="editor-text">{{ old('en_description') }}</textarea>

                                @if ($errors->has('en_description'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('en_description') }}</span>
                                @endif

                            </div>

                            <div class="input__group mb-25">
                                <label>Meta Description <span class="text-danger">*</span></label>
                                <input type="text" name="meta_description" value="{{ old('meta_description') }}" placeholder="meta description" class="form-control">
                                @if ($errors->has('en_title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('en_title') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label>Meta Keywords <span class="text-danger">*</span></label>
                                <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="meta keywords" class="form-control">
                                @if ($errors->has('en_title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('en_title') }}</span>
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
