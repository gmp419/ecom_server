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
                        <h5 class="mb-0">Orders Summary</h5>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Invoice no.</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Order Date</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delivery Address</th>
                                <th>Contact</th>
                                <th>Payment method</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completed_orders as $order)
                            <tr>
                                <td class="fw-bold">{{$order->id}}</td>
                                <td class=" text-decoration-underline">{{$order->invoice_number}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->size}}</td>
                                <td>{{$order->color}}</td>
                                <td>{{$order->order_date}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->delivery_address}}</td>
                                <td>{{$order->contact}}</td>
                                <td>{{$order->payment_method}}</td>
                                
                                <td>
                                    <div class="badge rounded-pill bg-secondary text-dark text-white w-100">{{$order->order_status}}</div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info rounded btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Status
                                    </button>

                                    <!-- Modal -->
                                    <form action="{{route('order.status', $order->id )}}" method="post">
                                        @csrf
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change status?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <select class="form-select form-select-sm" name="order_status" aria-label=".form-select-sm example">
                                                            <option selected>Select status</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="process">Processing</option>
                                                        </select>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm rounded-4 btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-sm rounded-4 btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

@endsection