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
                                <h2>{{__('app.all_blog')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('blog.index')}}">{{__('app.all_blog')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.edit_blog')}}</li>
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
                            <h2>{{__('app.edit_blog')}}</h2>
                        </div>
                        <form action="{{route('blog.update', [$blog->uuid])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="input__group mb-25">
                                <label>{{__('app.title')}} <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{$blog->title}}" placeholder="{{__('app.title')}}" class="form-control slugable"  onkeyup="slugable()">
                                @if ($errors->has('title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label>{{__('app.slug')}} <span class="text-danger">*</span></label>
                                <input type="text" name="slug" value="{{$blog->slug}}" placeholder="{{__('app.slug')}}" class="form-control slug" onkeyup="getMyself()">
                                @if ($errors->has('slug'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('slug') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label for="blog_category_id"> Blog category </label>
                                <select name="blog_category_id" id="blog_category_id">
                                    <option value="">--Select Option--</option>
                                    @foreach($blogCategories as $blogCategory)
                                        <option value="{{ $blogCategory->id }}" @if($blogCategory->id = $blog->blog_category_id) selected @endif>{{ $blogCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label>Status</label>
                                <select name="status" id="status">
                                    <option value="">--Select Option--</option>
                                    <option value="1" @if($blog->status == 1) selected @endif>Published</option>
                                    <option value="0" @if($blog->status != 1) selected @endif>Unpublished</option>
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label for="tag_ids"> Tag </label>
                                <select name="tag_ids[]" multiple id="tag_ids" class="multiple-basic-single form-control">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, @$blog->tags->pluck('tag_id')->toArray() ?? []) ? 'selected' : null }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input__group mb-25">
                                <label>{{__('app.details')}} <span class="text-danger">*</span></label>
                                <textarea name="details" id="editor-text">{{$blog->details}}</textarea>

                                @if ($errors->has('details'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('details') }}</span>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="upload-img-box mb-25">
                                        @if($blog->image)
                                            <img src="{{asset($blog->image_path)}}" alt="img">
                                        @else
                                            <img src="" alt="No img">
                                        @endif
                                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('app.image')}}</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                    @endif
                                    <p>Accepted Image Files: JPEG, JPG, PNG <br> Recommend Size: 870 x 500 (1MB)</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right">
                                    @updateButton
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
    <script src="{{asset('admin/js/custom/slug.js')}}"></script>
    <script src="{{asset('admin/js/ckeditor.js')}}"></script>
    <script src="{{asset('admin/js/custom/form-editor.js')}}"></script>
@endpush
