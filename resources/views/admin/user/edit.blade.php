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
                                <h2>{{__('app.edit_user')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">{{__('app.all_users')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-horizontal__item bg-style">
                        <div class="item-top mb-30">
                            <h2>{{__('app.edit_user')}}</h2>
                        </div>
                        <form action="{{route('user.update', [$user->id])}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="custom-form-group mb-3 row">
                                <label for="name" class="col-lg-3 text-lg-right text-black"> {{__('app.name')}} </label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control flat-input" placeholder=" {{__('app.name')}} ">
                                    @if ($errors->has('name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="custom-form-group mb-3 row">
                                <label for="email" class="col-lg-3 text-lg-right text-black"> {{__('app.email')}} </label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control flat-input" placeholder=" {{__('app.email')}} ">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="custom-form-group mb-3 row">
                                <label for="phone_number" class="col-lg-3 text-lg-right text-black"> {{__('app.phone')}} </label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone_number" id="phone_number" value="{{$user->phone_number}}" class="form-control flat-input" placeholder=" {{__('app.phone')}} ">
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="custom-form-group mb-3 row">
                                <label for="address" class="col-lg-3 text-lg-right text-black"> {{__('app.address')}} </label>
                                <div class="col-lg-9">
                                    <textarea name="address" id="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="custom-form-group mb-3 row">
                                <label for="role_name" class="col-lg-3 text-lg-right text-black"> {{__('app.select_role')}} </label>
                                <div class="col-lg-9">
                                    <select name="role_name" id="role_name" class="form-control">
                                        <option value="">{{__('app.select_role')}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}"  @if(count($user->getRoleNames()) > 0) {{$user->getRoleNames()[0] == $role->name ? 'selected' : '' }}@endif >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('role_name') }}</span>
                                    @endif
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

