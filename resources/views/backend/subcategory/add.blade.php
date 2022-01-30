@extends('admin.admin_master')

@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">Subategory</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add subcategory</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->

                    <div class="col-lg-9 pb-4 mt-4">
                        <form action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                            @elseif(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>

                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h5>Add new subcategory</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category name</h6>
                                        </div>
                                        <div class="col-sm-9  text-secondary form-group">
                                            <select name="category_name" class="form-control" id="exampleFormControlSelect1">
                                                @foreach($categories as $category)
                                                <option>{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Subategory name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control " name="subcategory_name" value="">
                                            @error('subcategory_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row pb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Add">
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


@endsection