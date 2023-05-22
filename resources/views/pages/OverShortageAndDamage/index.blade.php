@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Over, Short and Damage List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('overshortanddamage.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('overshortanddamage.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_balanceorder">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Over / Short and Damage Report Number</td>
                                    <td>Goods Receiving Number</td>
                                    <td>Purchase Order Number</td>
                                    <td>Supplier Code</td>
                                    {{-- <td>Stock Number</td>
                                    <td>Serial Number</td>
                                    <td>Batch Number</td>
                                    <td>Quantity</td>
                                    <td>Expire Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($overshortanddamages as $overshortanddamage)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $overshortanddamage->over_short_damage_report_number}}</td>
                                    <td>{{ $overshortanddamage->grn_number}}</td>
                                    <td>{{ $overshortanddamage->po_number}}</td>
                                    <td>{{ $overshortanddamage->supplier_code}}</td>
                                    <td>{{ $overshortanddamage->stock_number}}</td>
                                    <td>{{ $overshortanddamage->serial_number}}</td>
                                    <td>{{ $overshortanddamage->batch_number}}</td>
                                    <td>{{ $overshortanddamage->quantity}}</td>
                                    <td>{{ $overshortanddamage->expire_date}}</td>

                                     <td>
                                        <a href="{{ route('disposal.edit', $disposal->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('disposal.delete', $disposal->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>

                                        <a href="{{ route('disposal.view', $disposal->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i>
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
            $('#tbl_balanceorder').DataTable();
        } );
    </script>
@endpush
