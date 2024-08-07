@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>  Stock Nill Item List</h2>

                        <div class="table-responsive">
                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="tbl_stockitem">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Stock Number</td>
                                        <td>Descritption</td>
                                        <td>Unit</td>
                                        <td>On Hand Qty</td>
                                        <td>Warehouse</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($stock_balance as $stock)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{optional(optional( $stock)->item)->stock_number }}</td>
                                            <td>{{optional(optional( $stock)->item)->description }}</td>
                                            <td>{{optional(optional( $stock)->item)->unit }}</td>
                                            <td>{{optional($stock)->qty }}</td>
                                             <td>{{optional(optional($stock)->warehouse)->warehouse_name }}</td>
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
            $('#tbl_stockitem').DataTable();
        } );
    </script>
@endpush
