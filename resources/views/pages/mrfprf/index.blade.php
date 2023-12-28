@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Procurement Request Through Material Request</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('mrfprf.create') }}" class="btn btn-success float-end mb-2"> Create New </a>
                        {{-- <a href="{{ route('department.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                    <table class="table bordered form-group">
                        <table class="table table-bordered" id="tbl_mrfprf">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>PRF Date</td>
                                    <td>PRF No</td>
                                    <td>Items</td>
                                    <td>Created By</td>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $list->mrfprf_date }}</td>
                                    <td>{{ $list->mrfprf_no }}</td>
                                    <td>
                                        <table class="table table-striped">
                                            <tr>
                                                <th scope="col" >#</th>
                                                <th scope="col" >S/No</th>
                                                <th scope="col" >Descrition</th>
                                                <th scope="col" >U/M</th>
                                                <th scope="col" >Qty</th>
                                                </tr>
                                            @foreach ($list->items as $prItems)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $prItems->item->stock_number }}</td>
                                                <td>{{ $prItems->item->description }}</td>
                                                <td>{{ $prItems->item->unit }}</td>
                                                <td>{{ $prItems->prfqty }}</td>
                                                
                                            </tr>
                                        @endforeach
                                        </table>
                                    </td>

                                    <td>{{ $list->createUser ? $list->createUser->name : 'User not found' }}</td>
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
            $('#tbl_mrfprf').DataTable();
        } );
    </script>
@endpush
