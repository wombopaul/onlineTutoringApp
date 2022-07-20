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
                                <h2>{{__('app.blogs')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.blogs')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30 admin-dashboard-blog-list-page">
                        <div class="item-title d-flex justify-content-between">
                            <h2>{{__('app.blog_list')}}</h2>
                            <a href="{{route('blog.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> {{__('app.add_blog')}} </a>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>{{__('app.image')}}</th>
                                    <th>{{__('app.title')}}</th>
                                    <th>{{__('app.category')}}</th>
                                    <th>{{__('app.status')}}</th>
                                    <th>{{__('app.name')}}</th>
                                    <th>{{__('app.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr class="removable-item">
                                        <td>
                                            <div class="admin-dashboard-blog-list-img">
                                                <img src="{{getImageFile($blog->image_path)}}" alt="img">
                                            </div>
                                        </td>
                                        <td>
                                            {{$blog->title}}
                                        </td>
                                        <td>
                                            {{$blog->category ? $blog->category->name : '' }}
                                        </td>
                                        <td>
                                            @if($blog->status == 1)
                                                <span class="status bg-green">Published</span>
                                            @else
                                                <span class="status bg-red">Unpublished</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $blog->user ? $blog->user->name : '' }}
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="{{route('blog.edit', [$blog->uuid])}}" title="Edit" class="btn-action">
                                                    <img src="{{asset('admin/images/icons/edit-2.svg')}}" alt="edit">
                                                </a>
                                                <a href="javascript:void(0);" data-url="{{route('blog.delete', [$blog->uuid])}}" title="Delete" class="btn-action delete">
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
    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>
@endpush
