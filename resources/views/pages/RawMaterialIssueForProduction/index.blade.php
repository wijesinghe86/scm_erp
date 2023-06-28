@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Raw Material Issue For Production List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('rawmaterialissueforproduction.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        </div>
                        <table class="table table-bordered" id="tbl_rawmaterialissueforproduction">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>RMR No</td>
                                    <td>RMI No</td>
                                    <td>Requested Item</td>
                                    <td>Issued Serial No</td>
                                    <td>Qty</td>
                                    <td>Weight</td>
                                   <td>Location</td>
                                   <td>Issued by</td>
                                </tr>
                            </thead>

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

