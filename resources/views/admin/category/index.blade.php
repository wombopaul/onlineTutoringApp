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
                                    <h2>{{__('app.categories')}}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{__('app.categories')}}</li>
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
                                <h2>{{__('app.category_list')}}</h2>
                                <a href="{{route('category.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> {{__('app.add_category')}} </a>
                            </div>
                            <div class="customers__table">
                                <table id="customers-table" class="row-border data-table-filter table-style">
                                    <thead>
                                    <tr>
                                        <th>{{__('app.image')}}</th>
                                        <th>{{__('app.name')}}</th>
                                        <th>{{__('app.feature')}}</th>
                                        <th>Total Course</th>
                                        <th>{{__('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr class="removable-item">
                                        <td>
                                            <div class="user-info">
                                                <div class="user-info__img">
                                                    <img src="{{getImageFile($category->image_path)}}" alt="category">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>
                                            @if($category->is_feature == 'yes')
                                                <span class="status active">Yes</span>
                                            @else
                                                <span class="status blocked">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ @$category->courses->count() }}
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="{{route('category.edit', [$category->uuid])}}" class="btn-action" title="Edit">
                                                    <img src="{{asset('admin/images/icons/edit-2.svg')}}" alt="edit">
                                                </a>
                                                <a href="javascript:void(0);" data-url="{{route('category.delete', [$category->uuid])}}" class="btn-action delete" title="Delete">
                                                    <img src="{{asset('admin/images/icons/trash-2.svg')}}" alt="trash">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Page content area end -->
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}" />
@endpush

@push('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>
@endpush
