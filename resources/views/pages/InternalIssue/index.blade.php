@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Internal Issue Materials Status</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('internal_issue.create') }}"
                                    class="btn btn-success float-end mb-2"> Add New </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                                <table class="table table-bordered" id="tbl_materialrequest">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>IID Date</td>
                                            <td>IID No</td>
                                            {{-- <td>Warehouse</td> --}}
                                            <td>Items</td>
                                            {{-- <td>Total Issued Qty</td>
                                            <td>Total Issued Weight</td> --}}
                                            <td>Created_by</td>
                                            <td>Action</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $internalissue)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $internalissue->iid_date }}</td>
                                                <td>{{ $internalissue->iid_no }}</td>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th scope="col" >#</th>
                                                            <th scope="col" >S/No</th>
                                                            <th scope="col" >Descrition</th>
                                                            <th scope="col" >U/M</th>
                                                            <th scope="col" >Qty</th>
                                                            <th scope="col" >Weight</th>
                                                        </tr>
                                                        @foreach ($internalissue->iid_items as $internal_issue_item)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ $internal_issue_item->item->stock_number }}</td>
                                                                <td>{{ $internal_issue_item->item->description }}</td>
                                                                <td>{{ $internal_issue_item->item->unit }}</td>
                                                                <td>{{ $internal_issue_item->issue_qty }}</td>
                                                                <td>{{ $internal_issue_item->issue_weight }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                </td>
                                                {{-- <td>{{ $internalissue->total_issued_qty }}</td>
                                                <td>{{ $internalissue->total_issued_weight }}Kg</td> --}}
                                                <td>{{ $internalissue->createUser ? $internalissue->createUser->name : 'User not found' }}
                                                </td>
                                                <td align="center">
                                                    <a class="h4"
                                                        href="{{ route('internal_issue.view', $internalissue->id) }}">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $internalissue->status}}</td>
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
