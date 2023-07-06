@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Demand Forecasting Registry</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('demand-forecasting.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('department.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                    <div class="table-responsive">
                     <table class="table table-bordered" id="tbl_demandforecasting">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>DF No</td>
                                    <td>DF Date</td>
                                    <td>Items</td>
                                    <td>Created By</td>

                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($demandforecastings as $demandforecasting)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $demandforecasting->df_no }}</td>
                                    <td>{{ $demandforecasting->df_date }}</td>
                                    <td>
                                    <table class="table table-striped">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >S/No</th>
                                            <th scope="col" >Descrition</th>
                                            <th scope="col" >U/M</th>
                                            <th scope="col" >Qty</th>
                                        </tr>
                                    @foreach ($demandforecasting->items as $dfItems)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $dfItems->item->stock_number }}</td>
                                                            <td>{{ $dfItems->item->description }}</td>
                                                            <td>{{ $dfItems->item->unit }}</td>  
                                                            <td>{{ $dfItems->qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </table>
                                            </td>
                                            </td>
                                    <td>{{ $demandforecasting->createUser ? $demandforecasting->createUser->name : 'User not found' }}</td>
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
