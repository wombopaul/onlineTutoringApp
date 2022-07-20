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
                                <h2>{{__('app.edit_language')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('course-language.index')}}">{{__('app.langiages')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.edit_language')}}</li>
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
                            <h2>{{__('app.edit_language')}}</h2>
                        </div>
                        <form action="{{route('course-language.update', [$language->uuid])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="input__group mb-25">
                                <label for="name"> {{__('app.name')}} </label>
                                <div>
                                    <input type="text" name="name" id="name" value="{{$language->name}}" class="form-control" placeholder=" {{__('app.name')}} ">
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
