@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Material Requests</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('material_request.create') }}" class="btn btn-success float-end mb-2"> Add
                                    New </a>
                                {{-- <a href="{{ route('warehouse.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <table class="table table-bordered" id="tbl_materialrequest">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>MRF Date</td>
                                        <td>MRF No</td>
                                        <td>Items</td>
                                        <td>Created_by</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $materialrequest)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $materialrequest->mrf_date }}</td>
                                            <td>{{ $materialrequest->mrf_no }}</td>
                                            <td>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th scope="col" >#</th>
                                                        <th scope="col" >S/No</th>
                                                        <th scope="col" >Descrition</th>
                                                        <th scope="col" >U/M</th>
                                                        <th scope="col" >Qty</th>
                                                    </tr>
                                                    @foreach ($materialrequest->request_items as $material_request_item)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $material_request_item->item->stock_number }}</td>
                                                            <td>{{ $material_request_item->item->description }}</td>
                                                            <td>{{ $material_request_item->item->unit }}</td>
                                                            <td>{{ $material_request_item->mrf_qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            </td>
                                            <td>{{ $materialrequest->createUser ? $materialrequest->createUser->name : 'User not found' }}
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
