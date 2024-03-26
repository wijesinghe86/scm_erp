@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Credit Note Regsitry</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('credit_note.create') }}" class="btn btn-success mb-2 float-end mb-2"> Add new </a>
                            </div>

                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="invoices-table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>INVOICE DATE</td>
                                        <th>INVOICE NO</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>SALES STAFF NAME</th>
                                        <th>STATUS</th>
                                        <th>CREATED BY</th>
                                        {{-- <th>CREATED AT</th> --}}
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   
@endpush

@push('styles')
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endpush
