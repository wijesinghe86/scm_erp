@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a> Stock Status Report</h3>
                        <br>
                        <br>
                        <h4><b>Location-wise Current Stock On Hand Report</b></h4>
                        <form method="POST" target="_blank"  action="{{ route('CurrentOnHandBalance.generate_stockOnHand_report') }}">
                            @csrf
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Warehouse</label>
                                    <select class="form-control select" id="warehouse_name" name="warehouse_name" required>
                                        <potion select disabled>Select Warehouse</potion>
                                        @foreach ($warehouse_lists as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                {{-- <div class="form-group col-md-2">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" name="frm_date" id="frm_date"
                                        placeholder="frm_date" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date"
                                        placeholder="to_date" required>
                                </div>
                            </div> --}}
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-success me-2" style="position: absolute; height:25%"> View and
                                        Print</button>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

