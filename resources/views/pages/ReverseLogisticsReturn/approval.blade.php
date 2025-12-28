<!-- @extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header">
                            <div style="margin-bottom: 20px;" class="row">
                                <div class="col-md-8">
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i
                                                class="mdi mdi-home"></i></a>Reverse Returns Approved Registry</h4>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="return-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>RETURN NUMBER</th>
                                            <th>INVOICE NUMBER</th>
                                            <th>CREATED BY</th>
                                            <th>APPROVED BY</th>
                                            <th>LOCATION</th>
                                            <th>RETURNED DATE</th>
                                            <th>VIEW</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($urgent_return as $key => $urgent_returns)
                                            <tr>
                                                <form method="POST"
                                                    action="{{ route('reverse_returns.approval', $urgent_returns->id) }}">
                                                    @csrf
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $urgent_returns->return_no }}</td>
                                                    <td>{{ $urgent_returns->get_invoice->invoice_number }}</td>
                                                    <td>{{ $urgent_returns->createdBy->name }}</td>
                                                    <td>{{ $urgent_returns->approvedBy ? $urgent_returns->approvedBy->name : 'Not Approved' }}
                                                    </td>
                                                    <td>{{ $urgent_returns->location->warehouse_name }}</td>
                                                    <td>{{ date('Y-m-d', strtotime($urgent_returns->created_at)) }}</td>
                                                     <td style="display:flex;gap:1rem; align-items: center;" align="right">
                                                        {{-- @if ($urgent_returns->is_approved)
                                                        <button type="submit"
                                                            class="btn btn-success">Approve</button>
                                                            @endif --}}
                                                       <a class="h4"
                                                            href="{{ route('reverse_returns.view', $urgent_returns->id) }}">
                                                            <i class="fa-sharp fa-solid fa-eye"></i>

                                                        </a>
                                                    </td>
                                                </form>
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
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#return-table').DataTable();
        });
    </script>
@endpush -->
