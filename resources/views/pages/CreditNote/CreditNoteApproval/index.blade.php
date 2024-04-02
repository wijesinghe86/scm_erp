@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Credit Note Approval Registry</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('credit_note_approval.create') }}"
                                    class="btn btn-success float-end mb-2">
                                    New Approval </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered data-table" id="cn_table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>CN NO</td>
                                            <th>INVOICE NO</th> 
                                            <th>REF.DOC.NO</th> 
                                            <th>CUSTOMER NAME</th>
                                              <th>ITEM</th> 
                                              <th>ACTION</th>
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
                                                    <th scope="col" >Status</th>
                                                   
                                                </tr>
                                                @foreach ($creditNote->items as $creditItem)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ $creditItem->stockItems->stock_number }}</td>
                                                                <td>{{ $creditItem->stockItems->description }}</td>
                                                                <td>{{ $creditItem->stockItems->unit }}</td>
                                                                <td>{{ $creditItem->credit_qty }}</td>
                                                                <td>{{ $creditItem->status }}</td>
                                                               
                                                            </tr>
                                                            @endforeach
                                                            </table>
                                                            <td>
                                                                <a href="{{ route('credit_note_print.view', $creditNote->id) }}">
                                                                    <i class="fa-sharp fa-solid fa-eye text-info"></i>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cn_table').DataTable();
        });
    </script>
@endpush
