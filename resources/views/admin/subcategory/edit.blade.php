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
                                <h2>{{__('app.edit_subcategory')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">{{__('app.subcategories')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.edit_subcategory')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-vertical__item bg-style">
                        <div class="item-top mb-30">
                            <h2>{{__('app.edit_subcategory')}}</h2>
                        </div>
                        <form action="{{route('subcategory.update', [$subcategory->uuid])}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="input__group mb-25">
                                <label for="category_id"> {{__('app.category')}} </label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$subcategory->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('category_id') }}</span>
                                @endif
                            </div>


                            <div class="input__group mb-25">
                                <label for="name"> {{__('app.name')}} </label>
                                <div>
                                    <input type="text" name="name" id="name" value="{{$subcategory->name}}" class="form-control" placeholder=" {{__('app.name')}} ">
                                    @if ($errors->has('name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input__group">
                                <div>
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


