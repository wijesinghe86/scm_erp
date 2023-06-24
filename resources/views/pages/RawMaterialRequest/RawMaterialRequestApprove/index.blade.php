@extends('layouts.app')

@section('content')
 <div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Raw Material Request Approval Registry</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('raw_material_request_approve.create') }}" class="btn btn-success float-end mb-2"> Approve </a>
                    </div>
                        <table class="table table-bordered" id="tbl_mrapprove">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Item No</td>
                                    <td>RMR No</td>
                                    <td>Requested By</td>
                                    <td>Approved Qty</td>
                                    <td>Approved Weight</td>
                                    <td>Status</td>
                                    <td>Approved By</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        @endsection
