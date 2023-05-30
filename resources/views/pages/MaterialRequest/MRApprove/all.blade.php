@extends('layouts.app')

@section('content')
 <div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
             <div class="card"> 
                <div class="card-body">  
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Material Request Approval Registry</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('mr_request_approve.create') }}" class="btn btn-success float-end mb-2"> Approve </a>
                    </div>
                        <table class="table table-bordered" id="tbl_mrapprove">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Item No</td>
                                    <td>MR No</td>
                                    <td>Requested By</td>
                                    <td>Approved Qty</td>
                                    <td>Status</td>
                                    <td>Approved For</td>
                                    <td>Approved By</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $row)
                                <tr>
                                    <td>{{$row->created_at->format("jS \of F h:i A")}}</td>
                                    <td>{{$row->item->description}}</td>
                                    <td>{{$row->materialRequest->mrf_no}}</td>
                                    {{-- <td>{{optional($row->materialRequest)->mrf_no}}</td> --}}
                                    <td>{{$row->created_by->name}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{$row->status}}</td>
                                    <td>{{$row->approved_for}}</td>
                                    <td>{{$row->created_by->name}}</td>
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
            $('#tbl_mrapprove').DataTable();
        } );
    </script>
@endpush
