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
                                <h2>Edit Contact Issue</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('contact.issue.index')}}">Contact Issue</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Contact Issue</li>
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
                            <h2>Edit Contact Issue</h2>
                        </div>
                        <form action="{{route('contact.issue.update', [$issue->id])}}" method="post">
                            @csrf
                            @method('patch')

                            <div class="input__group mb-25">
                                <label for="name"> {{__('app.name')}} </label>
                                <div>
                                    <input type="text" name="name" id="name" value="{{$issue->name}}" class="form-control" placeholder=" {{__('app.name')}} ">
                                    @if ($errors->has('name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="input__group mb-25">
                                <label for="status"> {{__('app.status')}} </label>
                                <div>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">--Select Option--</option>
                                        <option value="1" @if($issue->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($issue->status != 1) selected @endif>Deactivated</option>
                                    </select>
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

