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
                        <div class="breadcrumb-title pe-3">Slider</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit slider images</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->

                    <div class="col-lg-8 mt-4">
                        <form action="{{route('slider.update', $image->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{$image->id}}">

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                            @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ $message}}
                            </div>
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit slider</h5>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Slider image</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="file" name="slider_image"  id="image">
                                            @error('slider_image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img id="showImage" src="{{asset($image->slider_image)}}" alt="Admin" class="rounded-circle p-1 bg-primary" style="width: 100px; height: 100px;">

                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update">
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

<script>
    $(document).ready(function() {
        $('#image').change(function(e) {
            var image = new FileReader();
            image.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            image.readAsDataURL(e.target.files['0']);
        })
    })
</script>

@endsection