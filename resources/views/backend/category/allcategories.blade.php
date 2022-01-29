@extends('admin.admin_master')

@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Category list</h5>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{$category->category_image}}" alt="">
                                        </div>

                                    </div>
                                </td>
                                <td>{{$category->category_name}}</td>

                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{url('/category/edit',$category->id)}}" type="button" class="bg-facebook">
                                            <i class="bx bx-pencil text-white "></i>
                                        </a>
                                        <a href="{{route('deleteCategory',$category->id)}}" class="ms-4 bg-danger" id="delete" style="cursor: pointer;"><i class="bx bx-trash text-white"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="d-flex justify-content-end mt-2">
                        {{$categories->links('pagination::bootstrap-4')}}
                    </div>


            </div>

        </div>
    </div>

</div>
</div>

@endsection