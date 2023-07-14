@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bill Type Creation</h4>
                    <br>
                        <form action="{{ route('billtypes.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="item-name-label">BT Code</label>
                                        <input type="text" class="form-control border-input" name="billtype_code" id="billtype_code" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="item-name-label">Description</label>
                                        <input type="text" class="form-control border-input" name="billtype_description" id="billtype_description" required autocomplete="off">
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="item-name-label">Invoice Number</label>
                                        <input type="text" class="form-control border-input" name="invoice_no" id="invoice_no" required autocomplete="off">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success me-2">Complete Bill Type Creation</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .item-name-label{
        font-size: 1rem;
        font-weight: 800;
    }

    </style>
<style>

    .header{
        color:dimgrey;

    }
</style>


@endpush

