@extends('admin.admin_master')

@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @elseif(session('success'))
        <div class="alert alert-success">
            {{session('success')}}

        </div>
        @endif
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Subcategory list</h5>
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
                                <th>Category name</th>
                                <th>Subcategory name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{$subcategory->id}}</td>

                                <td>{{$subcategory->category_name}}</td>
                                <td>{{$subcategory->subcategory_name}}</td>

                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{route('subcategory.edit',$subcategory->id)}}" type="button" class="bg-facebook">
                                            <i class="bx bx-pencil text-white "></i>
                                        </a>
                                        <a href="{{route('deleteSubcategory',$subcategory->id)}}" class="ms-4 bg-danger" id="delete" style="cursor: pointer;"><i class="bx bx-trash text-white"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="d-flex justify-content-end mt-2">
                        {{$subcategories->links('pagination::bootstrap-4')}}
                    </div>


            </div>

        </div>
    </div>

</div>
</div>

@endsection