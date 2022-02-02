@extends('admin.admin_master')

@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Product list</h5>
                    </div>
                    <!-- <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div> -->
                </div>
                <hr>
                <table class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Product code</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($productLists as $productList)
                            <tr>
                                <td>{{$productList->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{$productList->product_image}}" alt="">
                                        </div>

                                    </div>
                                </td>
                                <td>{{$productList->title}}</td>
                                <td>{{$productList->product_code}}</td>
                                <td>{{$productList->category}}</td>

                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{route('product.edit',$productList->id)}}" type="button" class="bg-facebook">
                                            <i class="bx bx-pencil text-white "></i>
                                        </a> 
                                        <a href="{{route('product.delete',$productList->id)}}" id="delete" class="ms-4 bg-danger"  style="cursor: pointer;"><i class="bx bx-trash text-white"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="d-flex justify-content-end mt-2">
                        {{$productLists->links('pagination::bootstrap-4')}}
                    </div>
                </table>

            </div>

        </div>
    </div>

</div>
</div>

@endsection