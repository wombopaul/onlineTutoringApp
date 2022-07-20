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
                                <h2>{{__('app.add_language')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('language.index')}}">{{__('app.language_settings')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.translate')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row admin-dashboard-translate-your-language-page">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>  Translate Your Language (English => {{$language->language}} ) </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{route('update.translate', [$language->id])}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    @foreach($language_array as $key => $value)
                                        <div class="col-md-6 mt-3">
                                            <div class="input__group row justify-content-center">
                                                <label class="col-sm-5 col-form-label text-right text-black">{{ucwords(str_replace("_", " ", $key))}}  => </label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="{{$key}}" value="{{$value}}" placeholder="{{__('app.title')}}" class="form-control" aria-describedby="emailHelp" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="col-md-12 mt-3">
                                        <div class="row justify-content-end">
                                            <div class="col-md-6">
                                                <div class="form-group float-end">
                                                    <button type="submit" class="btn btn-blue">{{__('app.save')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Page content area end -->
@endsection
