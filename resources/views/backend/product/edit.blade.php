@extends('admin.admin_master')

@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->



        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit for {{$product->title}}</h5>
                <hr>

                @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @elseif(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>

                @endif
                <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="text" class="form-control" id="inputProductTitle" value="{{$product->title}}" name="title" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="inputProductTitle" class="form-label">Product Code</label>
                                            <input type="text" class="form-control" id="inputProductTitle" value="{{$product->product_code}}" name="product_code" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <input type="text" class="form-control" name="short_description" value="{{$productDetail->short_description}}" id="" rows="3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea class="form-control" id="" name="long_description" value="" rows="3" required>{{$productDetail->long_description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Display Image</label>
                                        <div class="text-secondary">
                                            <input class="form-control" type="file" name="product_image" id="image" value="{{$product->product_image}}" >
                                            @error('product_image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image 1</label>
                                        <div class="text-secondary">
                                            <input class="form-control" type="file" name="image1" id="image1" value="{{$productDetail->image1}}" >
                                            @error('image1')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image 2</label>
                                        <div class="text-secondary">
                                            <input class="form-control"  type="file" name="image2" id="image2" value="{{$productDetail->image2}}">
                                            @error('image2')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image 3</label>
                                        <div class="text-secondary">
                                            <input class="form-control" type="file" name="image3" id="image3" value="{{$productDetail->image3}}" >
                                            @error('image3')
                                            <span class="text-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image 4</label>
                                        <div class="text-secondary">
                                            <input class="form-control"  type="file" name="image4" id="image4" value="{{$productDetail->image4}}">
                                            @error('image4')
                                            <span class="text-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="text" name="price" class="form-control" id="inputPrice" value="{{$product->price}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Offer Price</label>
                                            <input type="text" name="offer_price" class="form-control" id="inputCompareatprice" value="{{$product->offer_price}}" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Category Type</label>
                                            <select name="category" class="form-control" id="exampleFormControlSelect1" required>
                                                <option></option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->category_name }}" {{ $category->category_name == $product->category ? 'selected': '' }}>{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputVendor" class="form-label">Subcategory Type</label>
                                            <select name="subcategory" class="form-control" id="exampleFormControlSelect2" required>
                                                <option></option>
                                                @foreach($subcategories as $subcategory)
                                                <option value="{{ $subcategory->subcategory_name }}" {{ $subcategory->subcategory_name == $product->subcategory ? 'selected': '' }}>{{$subcategory->subcategory_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Remark</label>
                                            <select class="form-select" required name="remark" id="inputCollection">
                                                <option value="{{ $product->remark }}" {{ $product->remark ? 'selected': '' }}>{{ $product->remark }}</option>
                                                <option value="new">NEW</option>
                                                <option value="featured">FEATURED</option>
                                                <option value="collection">COLLECTION</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputBrand" class="form-label">Brand</label>
                                            <input type="text" name="brand" required class="form-control" id="inputBrand" value="{{$product->brand}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputRating" class="form-label">Rating</label>
                                            <input type="text" name="star_rating" required class="form-control" id="inputRating" value="{{$product->star_rating}}">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Product Color</label>
                                            <input type="text" name="color" required value="{{$productDetail->color}}" class="form-control visually-hidden align-items-center" data-role="tagsinput" value="Red,White,Black">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Product Size</label>
                                            <input type="text" name="size" required value="{{$productDetail->size}}" class="form-control bg-facebook visually-hidden" data-role="tagsinput" value="S,M,L,XL,XXL">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary bg-facebook ">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>

@endsection