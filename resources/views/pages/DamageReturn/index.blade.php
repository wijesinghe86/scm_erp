@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Damage Return</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('damage_return.create') }}" class="btn btn-success float-end mb-2"> Add
                                    New </a>
                                {{-- <a href="{{ route('warehouse.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive">
                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="tbl_damagereturn">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Date</td>
                                        <td>DR No
                                        <td>Original Item</td>
                                        <td>Damage Item</td>
                                        <td>Qty</td>
                                        <td>Warehouse</td>
                                        <td>Created_by</td>
                                        <td>Print</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($damage_returns as $damage_return)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $damage_return->date }}</td>
                                            <td>{{ $damage_return->dr_no}}
                                            <td>{{ optional($damage_return->ori_items)->description}}</td>
                                            <td>{{ optional($damage_return->dmg_items)->description}}</td>
                                            <td>{{ $damage_return->qty}}</td>
                                            <td>{{ $damage_return->location->warehouse_name}}</td>
                                            <td>{{ $damage_return->createdBy ? $damage_return->createdBy->name : 'User not found' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('damage_return.print',['dr_id'=> $damage_return->id]) }}">

                                                    <i class="fa-sharp fa-solid fa-print"></i>
                                                </a>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_materialrequest').DataTable();
        });
    </script>
@endpush
