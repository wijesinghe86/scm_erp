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
                            <table class="table table-bordered" id="credit-table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>CN NO</td>
                                        <th>INVOICE NO</th> 
                                        <th>REF.DOC.NO</th> 
                                        <th>CUSTOMER NAME</th>
                                          <th>ITEM</th> 
                                        {{-- <th>DESCRIPTION</th>
                                        <th>U/M</th>   
                                        <td>Action</td>    --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($creditNotes as $creditNote )
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($creditNote)->credit_note_no }}</td>
                                    <td>{{ optional($creditNote->invoice)->invoice_number}}</td> 
                                    <td>{{ optional($creditNote->getSource())->sourceNo}}</td> 
                                    <td>{{ optional(optional($creditNote->invoice->customer))->customer_name}}</td>
                                    <td>
                                        <table class="table table-striped">
                                            <tr>
                                                <th scope="col" >#</th>
                                                <th scope="col" >S/No</th>
                                                <th scope="col" >Descrition</th>
                                                <th scope="col" >U/M</th>
                                                <th scope="col" >Qty</th>
                                            </tr>
                                            @foreach ($creditNote->items as $creditItem)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $creditItem->stockItems->stock_number }}</td>
                                                            <td>{{ $creditItem->stockItems->description }}</td>
                                                            <td>{{ $creditItem->stockItems->unit }}</td>
                                                            <td>{{ $creditItem->credit_qty }}</td>
                                                        </tr>
                                                        @endforeach
                                                        </table>

                                    {{-- <td>{{ optional($creditNote->creditItem)->stock_no}}</td> --}}
                                    {{-- <td>{{ optional(optional($creditNote->creditItem->stockItems))->stock_number }}</td>
                                    <td>{{ optional(optional($creditNote->creditItem->stockItems))->description }}</td>
                                    <td>{{ optional(optional($creditNote->creditItem->stockItems))->unit }}</td>   --}}
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
        $('#credit-table').DataTable();
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
