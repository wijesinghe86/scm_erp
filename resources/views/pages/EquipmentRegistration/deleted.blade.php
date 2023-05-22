@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Equipment Registration List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('equipmentregistration.index') }}" class="btn btn-primary float-end mb-2"> Equipment Registration List </a>
                        </div>
                        <table class="table table-bordered" id="tbl_equipmentregistration">
                            <thead>
                                <tr>
                                    <td>Equipment Code</td>
                                    <td>Stock Number</td>
                                    <td>Equipment Name</td>
                                    {{-- <td>Equipment Description</td>
                                    <td>Equipment Type</td>
                                    <td>Condition</td>
                                    <td>Power Source</td>
                                    <td>Use By</td>
                                    <td>Super Voiced By</td> --}}
                                    <td>Deleted By</td>
                                    <td>Deleted At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipmentregistrations as $equipmentregistration)
                                <tr>
                                    <td>{{ $equipmentregistration->equipment_code}}</td>
                                    <td>{{ $equipmentregistration->stock_number}}</td>
                                    <td>{{ $equipmentregistration->equipment_name}}</td>
                                    {{-- <td>{{ $equipmentregistration->equipment_description}}</td>
                                    <td>{{ $equipmentregistration->equipment_type}}</td>
                                    <td>{{ $equipmentregistration->condition}}</td>
                                    <td>{{ $equipmentregistration->power_source}}</td>
                                    <td>{{ $equipmentregistration->useby}}</td>
                                    <td>{{ $equipmentregistration->supervoicedby}}</td> --}}
                                    <td>{{ $equipmentregistration->deleteUser ? $equipmentregistration->deleteUser->name : 'User not found' }}
                                    <td>{{ $equipmentregistration->deleted_at }}</td>
                                    {{-- <td>
                                        <a href="{{ route('equipmentregistration.restore', $equipmentregistration->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i>
                                        </a>

                                        <a href="{{ route('equipmentregistration.delete.force', $equipmentregistration->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>
                                    </td> --}}

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
        $(document).ready( function () {
            $('#tbl_equipmentregistration').DataTable();
        } );
    </script>
@endpush
