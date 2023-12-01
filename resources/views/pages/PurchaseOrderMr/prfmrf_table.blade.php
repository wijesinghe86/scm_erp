<div class="table-responsive">
    <table class="table bordered form-group">
        <table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Requested Qty</th>
            <th>Order Qty</th>
            <th>Weight</th>
            <th>Unit Price</th>
            <th>Value</th>
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
                <td><input class="form-control" type="number" value="{{ $row->prfqty }}" readonly></td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][po_qty]" type="number"
                        value="{{ $row->prfqty }}">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][weight]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][Unit Price]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][Value]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                {{-- <td>{{$item['description']}}</td>
        <td>{{$item['uom']}}</td>
        <td>{{$item['priority']}}</td>
        <td>{{$item['prf_qty']}}</td> --}}

                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
