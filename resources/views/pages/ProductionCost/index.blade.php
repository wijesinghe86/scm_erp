@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Production Cost</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('productioncost.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('productioncost.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_productioncost">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Stock Number</td>
                                <td>Raw Material Number</td>
                                <td>Name of Production Materials</td>
                                {{-- <td>Materials Weight</td>
                                <td>Number of Materials</td>
                                <td>Number of Finish Goods</td>
                                <td>Production Hours</td>
                                <td>Production Labour Cost</td>
                                <td>Power Cost For Plant</td>
                                <td>Cost of Power for Batch Production</td>
                                <td>Weight of Material Wastage</td>
                                <td>Cost of Material Wastage</td>
                                <td>Production Cost for Batch Process</td>
                                <td>Production Cost Per Unit</td> --}}
                                <td>Created By</td>
                                {{-- <td>Approved by</td> --}}
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($productioncosts as $productioncost)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $productioncost->stock_number}}</td>
                            <td>{{ $productioncost->raw_material_number }}</td>
                            <td>{{ $productioncost->name_of_production_materials}}</td>
                            <td>{{ $productioncost->materials_weight }}</td>
                            <td>{{ $productioncost->number_of_materials }}</td>
                            <td>{{ $productioncost->number_of_finish_goods }}</td>
                            <td>{{ $productioncost->production_hours }}</td>
                             <td>{{ $productioncost->production_labour_cost}}</td>
                            <td>{{ $productioncost->power_cost_for_plant }}</td>
                            <td>{{ $productioncost->cost_of_power_for_batch_production}}</td>
                            <td>{{ $productioncost->weight_of_material_wastage }}</td>
                            <td>{{ $productioncost->cost_of_material_wastage }}</td>
                            <td>{{ $productioncost->production_cost_for_batch_process }}</td>
                            <td>{{ $productioncost->production_cost_per_unit }}</td>
                            <td>{{ $productioncost->createUser ? $productioncost->createUser->name : 'User not found' }}

                                <td>
                                    @if ($productioncost->productioncost_status == 1)
                                        <a href="{{ route('productioncost.deactive', $productioncost->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('productioncost.active', $productioncost->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('productioncost.view', $productioncost->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('productioncost.edit', $productioncost->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('productioncost.delete', $productioncost->id) }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>



                            </td>
                            </tr>
                            @endforeach
                        </tbody> --}}
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
            $('#tbl_productioncost').DataTable();
        } );
    </script>
@endpush
