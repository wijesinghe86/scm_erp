@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>  Stock Item Catalogue</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('stockitem.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                            <a href="{{ route('stockitem.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="tbl_stockitem">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Stock Number</td>
                                        <td>Descritption</td>
                                        <td>Unit</td>
                                        <td>Group</td>
                                        <td>Class</td>
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($stockitems as $StockItem)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $StockItem->stock_number }}</td>
                                            <td>{{ $StockItem->description }}</td>
                                            <td>{{ $StockItem->unit }}</td>
                                            <td>{{ $StockItem->group }}</td>
                                             <td>{{ $StockItem->class }}</td>

                                            <td>{{ $StockItem->createUser ? $StockItem->createUser->name : 'User not found' }}</td>

                                            <td>
                                                @if ($StockItem->stockItem_status == 1)
                                                    <a href="{{ route('stockitem.deactive', $StockItem->id) }}"
                                                        class="btn btn-primary btn-sm">Deactive</a>
                                                @else
                                                    <a href="{{ route('stockitem.active', $StockItem->id) }}"
                                                        class="btn btn-success btn-sm">Active</a>
                                                @endif
                                            </td>

                                            <td align="right" >
                                                <a class="h4" href="{{ route('stockitem.view', $StockItem->id) }}">
                                                    <i  class="fa-sharp fa-solid fa-eye"></i>
                                                </a>

                                                <a class="h4" href="{{ route('stockitem.edit', $StockItem->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a class="h4" href="{{ route('stockitem.delete', $StockItem->id) }}">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
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
        $(document).ready( function () {
            $('#tbl_stockitem').DataTable();
        } );
    </script>
@endpush
