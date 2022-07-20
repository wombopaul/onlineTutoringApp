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
                                <h2>{{__('app.add_tag')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('tag.index')}}">{{__('app.tags')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.add_tag')}}</li>
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
                                <h2>{{__('app.add_tag')}}</h2>
                            </div>
                            <form action="{{route('tag.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="input__group mb-25">
                                    <label for="name"> {{__('app.name')}} </label>
                                    <div>
                                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder=" {{__('app.name')}} ">
                                        @if ($errors->has('name'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="input__group">
                                    <div>
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
