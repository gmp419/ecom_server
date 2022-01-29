@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">User Profile</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->


                    <div class="col-lg-12 mt-4">
                        <form action="{{route('update_password')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif



                            <div class="card">
                                <div class="card-header align-items-center">
                                    <h5>Change Password:</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Current Password:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="current_password" type="password" name="current_password" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">New Password:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="password" type="password" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Confirm Password:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id=" password_confirmation" type="password" name="password_confirmation" value="">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Submit">
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