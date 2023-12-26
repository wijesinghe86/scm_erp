@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Purchase Request Approval Registry</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('pr_request_approve.create') }}"
                                    class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered data-table" id="pps_table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>PR No</td>
                                            <td>MR No</td>
                                            <td>Item</td>
                                            <td>Quantity</td>
                                            <td>Created By</td> 
                                            <td>Status</td>
                                            <td>Approved By</td>
                                            <td>Remark</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional(optional($item)->mrf_prf)->mrfprf_no }}</td>
                                                <td>{{ optional(optional($item)->material_request)->mrf_no }}</td>
                                                <td>{{ optional(optional($item)->item)->description }}</td>
                                                <td>{{ $item->prfqty }}</td>
                                               <td>{{ $item->mrf_prf->createUser->name }}</td> 
                                                <td>{{ $item->approval_status }}</td>
                                                <td>{{ optional(optional($item)->approvedBy)->name }}</td>
                                                <td>{{ $item->remark }}</td>  
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     $('#pps_table').DataTable();
        // });
    </script>
@endpush
