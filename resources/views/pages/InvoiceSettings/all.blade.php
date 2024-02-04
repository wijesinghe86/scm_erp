@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Invoice
                            Records</h2>
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('invoicesettings.new') }}" class="btn btn-success mb-2 float-end mb-2">
                                Add new </a>
                        </div>

                        <table class="table bordered form-group">
                            <table class="table table-bordered" id="invoices-table">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Invoice Type</td>
                                    <th>Invoice Category Code</th>
                                    <th>Option</th>
                                    <th>Status</th>
                                    {{-- <th>CREATED AT</th> --}}
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{ $setting->invoiceType->name }}</td>
                                        <td> {{ $setting->invoice_category }}</td>
                                        <td> {{ $setting->invoiceOption->name }}</td>
                                        <td></td>
                                        {{-- <td>{{ $invoice->created_at }}</td> --}}
                                        <td>
                                            <a href="">
                                                <i class="fa-sharp fa-solid fa-eye fa-lg text-info"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa-sharp fa-solid fa-trash fa-lg text-danger"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa-sharp fa-solid fa-print fa-lg"></i>
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
        $(document).ready(function () {
            $('#invoices-table').DataTable(

            );
        });
    </script>
@endpush

@push('styles')
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endpush
