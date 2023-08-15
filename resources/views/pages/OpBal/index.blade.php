@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Openning Balance Report</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('obentry.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('department.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                    <div class="table-responsive">
                     <table class="table table-bordered" id="tbl_demandforecasting">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Ref No</td>
                                    <td>Stock No</td>
                                    <td>Description</td>
                                    <td>Unit</td>
                                    <td>Quantity</td>
                                    <td>Warehouse</td>
                                    <td>Created By</td>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($openingBalance as $openingBal)
                               <tr>
                                   <td>{{$openingBal->date}}</td>
                                   <td>{{$openingBal->ref_no }}</td>
                                   <td>{{ $openingBal->items->stock_number }}</td>
                                   <td>{{ $openingBal->items->description }}</td>
                                   <td>{{ $openingBal->items->unit }}</td>
                                   <td>{{ $openingBal->qty }}</td>
                                   <td>{{ $openingBal->location->warehouse_name }}</td>
                                   <td>{{ $openingBal->createdBy->name }}</td>
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
        $('#tbl_demandforecasting').DataTable({
            "order": [
                [0, "asc"]
            ],

            "lenghtMenu":[
            //     [10, 25, 50, -1],
                [100, 150, 200, "All"]
            ],
        });
    });
</script>
@endpush
