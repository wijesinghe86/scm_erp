@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Credit Limit Log</h2>
                            <br>

                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="payment-table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>CUSTOMER CODE</td>
                                        <th>CUSTOMER NAME</th>
                                        <th>CREDIT LIMIT</th>                    
                                        <th>CREATED BY </th>
                                        <th>CREATED DATE </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $creditLimitLogs as  $creditLimitLog )
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($creditLimitLog)->customer_code }}</td>
                                    <td>{{ optional($creditLimitLog)->customer_name}}</td>
                                    <td>{{ optional($creditLimitLog)->credit_limit}}</td>
                                    <td>{{optional($creditLimitLog)->created_by}}</td>
                                    <td>{{optional($creditLimitLog)->created_at}}</td>
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
        $('#payment-table').DataTable();
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

