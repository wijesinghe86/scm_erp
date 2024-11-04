@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Finished Goods List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('finishedgoods.create') }}" class="btn btn-success float-end mb-2"> Add New
                                </a>
                                {{-- <a href="{{ route('finishedgoods.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>

                                                 <table class="table table-striped">

                                                        <tr>
                                                            <td>#</td>
                                                            <td>Stock Number</td>
                                                            <td>Description</td>
                                                            <td>Qty</td>
                                                            <td>Batch</td>
                                                        </tr>
                                                        @foreach ($fgrn_items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                               <td>{{ optional(optional($item)->stock_item_by_stockNumber)->stock_number }}</td>
                                                                <td>{{optional(optional($item)->stock_item_by_stockNumber)->description }}</td>
                                                                <td>{{ $item->pro_qty }}</td>
                                                                <td>{{ $item->batch_no }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_finishedgoods').DataTable();
        });
    </script>
@endpush
