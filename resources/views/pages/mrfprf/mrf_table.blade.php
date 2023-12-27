<div class="table-responsive">
    <table class="table bordered form-group">
<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Priority</th>
            <th>Approved Qty</th>
            <th>Requested Qty</th>
            <th>Unit Price</th>
            <th>Value</th>
            <th>Purchase Request Qty</th>
            
            
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $index => $row)
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>
                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td>{{ $row->priority }}</td>
                <td>{{ $row->approval_purchase->sum('remaining_qty') }}</td>
                <td><input class="form-control" type="number" value="{{ $row->mrf_qty }}" readonly></td>
                <td>{{ $row->item->cost_price }}</td>
                <td>{{ $row->value }}</td>
                <td>
                <input class="form-control" name="items[{{ $index }}][qty]" type="number"
                        value="{{ $row->approval_purchase->sum('remaining_qty') }}">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                {{-- <input class="form-control" name="items[{{ $index }}][df_qty]" type="number"
                        value="{{ $row->mrf_qty }}">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td> --}}

                {{-- <td>{{$item['description']}}</td>
        <td>{{$item['uom']}}</td>
        <td>{{$item['priority']}}</td>
        <td>{{$item['prf_qty']}}</td> --}}

                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
                
            </tr>
        @endforeach
    </tbody>
</table>
