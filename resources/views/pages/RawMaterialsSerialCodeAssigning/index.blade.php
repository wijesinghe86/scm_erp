@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Raw Materials Serial Code Assigning Catalogue </h4>
                    <br>
                            <br>
                            <div class ="container">
                                <div class="row m-2">
                                    <form action="" class="col-9">
                                        <div class="form-group">
                                            <input type="text" name="search" id="" class="form-control"
                                                placeholder="Search by GRN No / Stock No / Serial No "
                                                value="{{ request('search') }}">
                                        </div>
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ route('rawmaterialsserialcodeassigning.index') }}">
                                            <button class="btn btn-primary" type="button">Reset</button>
                                        </a>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
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
                       {{ $list->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_rawmaterialsserialcodeassigning').DataTable();
        } );
    </script>
@endpush --}}
