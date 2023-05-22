@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Bill Type List</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('billtypes.new') }}" class="btn btn-success mb-2">New Bill Type</a>
                            </div>
                            <table class="table table-bordered" id="tbl_billtype">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>BT CODE</th>
                                        <th>Description</th>
                                        {{-- <th>Invoice No</th> --}}
                                        <th>CREATED BY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($billtypes as $billtype)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $billtype->billtype_code }}</td>
                                            <td>{{ $billtype->billtype_description }}</td>
                                            {{-- <td>{{ $billtype->invoice_no }}</td> --}}
                                            <td>{{ $billtype->createUser ? $billtype->createUser->name : 'User not found' }}
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
            $('#tbl_billtype').DataTable();
        });
    </script>
@endpush
