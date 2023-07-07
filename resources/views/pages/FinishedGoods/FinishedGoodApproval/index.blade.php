@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Finished Goods Inspected List</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tbl_finishedgoods">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Finished Goods Number</td>
                                        <td>Raw Material Issue Number</td>
                                        <td>Status</td>
                                        <td>Created By</td>
                                        <td>Inspected By</td>
                                        <td>Inspected At</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finished_goods_list as $fgrn)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fgrn->fgrn_no }}</td>
                                            <td>{{ $fgrn->rmi->rmi_no }}</td>
                                            <td>{{ $fgrn->status }}</td>
                                            <td>{{optional(optional($fgrn)->createdBy)->name }}</td>
                                            <td>{{optional(optional($fgrn)->inspectedBy)->name }}</td>
                                            <td>{{ date('Y-m-d H:s', strtotime($fgrn->inspected_at)) }}</td>
                                            <td>
                                                <a href="{{ route('finished_goods_approval.create', $fgrn->id) }}"
                                                    class="btn btn-primary">Inspect</a>
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
