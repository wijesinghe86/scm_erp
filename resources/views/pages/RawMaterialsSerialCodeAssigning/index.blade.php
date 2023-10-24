@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Raw Materials Serial Code Assigning Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('rawmaterialsserialcodeassigning.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('rawmaterialsserialcodeassigning.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_rawmaterialsserialcodeassigning">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>GRN No</td>
                                    <td>Stock Number</td>
                                    <td>Description</td>
                                    <td>Serial No</td>
                                    <td>Qty</td>
                                    <td>Created By</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $rawmaterialsserialcodeassigning)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->grn->grn_no}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->item->stock_number}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->item->description}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->serial_no }}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->qty }}</td>
                                    {{-- <td>
                                        <table class="table table-striped">
                                            <tr>
                                                <th scope="col" >#</th>
                                                <th scope="col" >Stock No</th>
                                                <th scope="col" >Description</th>
                                                <th scope="col" >Serial No</th>
                                                <th scope="col" >Weight</th>
                                            </tr>
                                            @foreach ($list as $rawmaterialsserialcodeassigning)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td> --}}
                                                    {{-- <td>{{ $rawmaterialsserialcodeassigning->item->stock_number}}</td>
                                                    <td>{{ $rawmaterialsserialcodeassigning->item->description}}</td>
                                                    <td>{{ $rawmaterialsserialcodeassigning->serial_no }}</td>
                                                    <td>{{ $rawmaterialsserialcodeassigning->qty }}</td>
                                                </tr>
                                             @endforeach

                                        </table> --}}
                                    {{-- </td> --}}
                                    <td>{{ $rawmaterialsserialcodeassigning->createUser ? $rawmaterialsserialcodeassigning->createUser->name : 'User not found' }}
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
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_rawmaterialsserialcodeassigning').DataTable();
        } );
    </script>
@endpush
