@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Operation Mechanism By Product</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('operationmechanismbyproduct.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('operationmechanismbyproduct.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_operationmechanismbyproduct">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Date</td>
                                <td>Production Planning Schedule Number</td>
                                <td>Job Order Number</td>
                                {{-- <td>Product Kind</td>
                                <td>Time period</td>
                                <td>Product Name</td>
                                <td>Coefficient of Product</td>
                                <td>Ordered Quantity</td>
                                <td>Inventory Quantity</td>
                                <td>WIP Quantity</td>
                                <td>Overall Inventory Target</td>
                                <td>Front area WIP Quantity</td>
                                <td>Back Area Quantity</td>
                                <td>Tolerant Start Time of Operation</td> --}}
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($operationmechanismbyproducts as $operationmechanismbyproduct)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $operationmechanismbyproduct->date}}</td>
                            <td>{{ $operationmechanismbyproduct->production_planning_schedule_number }}</td>
                            <td>{{ $operationmechanismbyproduct->job_order_number}}</td>
                            <td>{{ $operationmechanismbyproduct->product_kind }}</td>
                            <td>{{ $operationmechanismbyproduct->time_period }}</td>
                            <td>{{ $operationmechanismbyproduct->product_name }}</td>
                            <td>{{ $operationmechanismbyproduct->coefficient_of_product }}</td>
                             <td>{{ $operationmechanismbyproduct->ordered_quantity }}</td>
                            <td>{{ $operationmechanismbyproduct->inventory_quantity }}</td>
                            <td>{{ $operationmechanismbyproduct->wip_quantity}}</td>
                            <td>{{ $operationmechanismbyproduct->overall_inventory_target }}</td>
                            <td>{{ $operationmechanismbyproduct->front_area_wip_quantity }}</td>
                            <td>{{ $operationmechanismbyproduct->back_area_quantity }}</td>
                            <td>{{ $operationmechanismbyproduct->tolerant_start_time_of_operation }}</td>
                            <td>{{ $operationmechanismbyproduct->createUser ? $operationmechanismbyproduct->createUser->name : 'User not found' }}

                                <td>
                                    @if ($operationmechanismbyproduct->operationmechanismbyproduct_status == 1)
                                        <a href="{{ route('operationmechanismbyproduct.deactive', $operationmechanismbyproduct->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('operationmechanismbyproduct.active', $operationmechanismbyproduct->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('operationmechanismbyproduct.view', $operationmechanismbyproduct->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('operationmechanismbyproduct.edit', $operationmechanismbyproduct->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('operationmechanismbyproduct.delete', $operationmechanismbyproduct->id) }}">
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
            $('#tbl_operationmechanismbyproduct').DataTable();
        } );
    </script>
@endpush
