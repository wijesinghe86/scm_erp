@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Finished Goods with Serial Code Report</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('finishedgoodsserialcodeassigning.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('finishedgoodsserialcodeassigning.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_finishedgoodsserialcodeassigning">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Finished Goods Number</td>
                                    <td>Job Order Number</td>
                                    <td>Batch Number</td>
                                    <td>Stock Number</td>
                                    <td>Finished Goods Serial Number</td>
                                    {{-- <td>Created By</td>
                                    <td>Created Date</td>
                                     --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($finishedgoodsserialcodeassignings as $finishedgoodsserialcodeassigning)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->finished_goods_number}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->job_order_number}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->batch_number}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->stock_number}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->finished_goods_serial_number}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->created_by}}</td>
                                    <td>{{ $finishedgoodsserialcodeassigning->created_date}}</td>

                                    <td>
                                        <a href="{{ route('finishedgoodsserialcodeassigning.edit', $finishedgoodsserialcodeassigning->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('finishedgoodsserialcodeassigning.delete', $finishedgoodsserialcodeassigning->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('finishedgoodsserialcodeassigning.view', $finishedgoodsserialcodeassigning->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i></a>
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
            $('#tbl_finishedgoodsserialcodeassigning').DataTable();
        } );
    </script>
@endpush
