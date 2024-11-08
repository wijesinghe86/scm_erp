@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title"> Internal Issue No: {{ $internalIssue->iid_no }} </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4 info-item">
                                <div>IID No :</div>
                                <div>{{ $internalIssue->iid_no }}</div>
                            </div>
                            <div class="form-group col-md-4 info-item">
                                <div>Issued Date :</div>
                                <div>{{ $internalIssue->iid_date }}</div>
                            </div>

                            <div class="form-group col-md-4 info-item">
                                <div>Issued Warehouse :</div>
                                <div>{{ $internalIssue->warehouse->warehouse_name }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 info-item">
                                <div>Plant:</div>
                                <div>{{ $internalIssue->plant->plant_name }}</div>
                            </div>
                            <div class="form-group col-md-4 info-item">
                                <div>Created By :</div>
                                <div>{{ $internalIssue->createUser->name }}</div>
                            </div>
                            <div class="form-group col-md-4 info-item">
                                <div>Approved :</div>
                                <div>{{ $internalIssue->approved_by ? $internalIssue->approvedBy->name : 'Not Approved' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 info-item">
                                <div>Total Issued Qty:</div>
                                <div>{{ $internalIssue->total_issued_qty}}</div>
                            </div>
                            <div class="form-group col-md-4 info-item">
                                <div>Total Issued Weight:</div>
                                <div>{{ $internalIssue->total_issued_weight}}Kg</div>
                            </div>
                        </div>
                        @if (!$internalIssue->is_approved)
                        <form class="row form-group" method="POST"
                            action="{{ route('internal_issue.approval', $internalIssue->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success col-sm-2">Approve</button>
                        </form>
                    @endif
                    <table class="table table-bordered" id="tbl_internalissue">
                        <thead>
                            <tr>
                                <td></td>
                                <td>STOCK NO</td>
                                <td>DESCRIPTION</td>
                                <td>U/M</td>
                                <td>ISSUED QUANTITY</td>
                                <td>ISSUED WEIGHT</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internalIssue->iid_items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->item->stock_number }}</td>
                                    <td>{{ $item->item->description }}</td>
                                    <td>{{ $item->item->unit }}</td>
                                    <td>{{ $item->issue_qty }}</td>
                                    <td>{{ $item->issue_weight }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                        <a href="{{ route('internal_issue.index') }}">
                            <button class="btn btn-light">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>
@endsection
