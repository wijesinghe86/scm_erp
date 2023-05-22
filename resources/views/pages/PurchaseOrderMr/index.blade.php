@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Purchase Order List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('purchase_order_mr.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('purchase_order.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a></div> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_purchase_order">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Purchase Order Number</td>
                                    <td>Supplier Code</td>
                                    <td>Purchase Reference Number</td>
                                    <td>Purchase Order Date</td>
                                    <td>Stock Number</td>
                                    <!-- <td>Purchase Order Type</td>
                                    <td>Purchase Order Quantity</td>
                                    <td>Weight Per Unit</td>
                                    <td>Volume Per Unit</td>
                                    <td>Total Weight</td>
                                    <td>Total Volume</td>
                                    <td>Warehouse Code</td>
                                    <td>Weight Per Unit</td>
                                    <td>Total Weight</td>
                                    <td>Total Volume</td>
                                    <td>Purchase Order Price Per Unit</td>
                                    <td>Ship To</td>
                                    <td>Intended Delivery Date</td>
                                    <td>Mode Of Delivery</td>
                                    <td>Approved By</td> -->

                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($locationbays as $location)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                            <td>{{ $location->warehouse_code}}</td>
                                <td>{{ $location->bay_number }}</td>
                                {{-- <td>{{ $location->bay_description }}</td>
                                <td>{{ $location->bay_height}}</td>
                                <td>{{ $location->bay_width }}</td>
                                <td>{{ $location->bay_length }}</td>
                                <td>{{ $location->bay_floor_area }}</td>
                                <td>{{ $location->createUser ? $location->createUser->name : 'User not found' }}</td>

                                <td>
                                    @if ($location->locationbaydesign_status == 1)
                                        <a href="{{ route('locationbaydesign.deactive', $location->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('locationbaydesign.active', $location->id) }}"
                                            class="btn btn-success btn-sm">Active</a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('locationbaydesign.view', $location->id) }}">
                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('locationbaydesign.edit', $location->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('locationbaydesign.delete', $location->id) }}">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </a>


                                </td>
                                </tr>
                                @endforeach
                            </tbody> --}}

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_purchase_order').DataTable();
        } );
    </script>
@endpush
