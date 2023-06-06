<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Approved PO Qty</th>
            <th>Received Qty</th>
            <th>Rec Weight</th>
            <th>Exp Date</th>
            <th>Batch No</th>
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
                <td><input class="form-control" type="number" value="{{ $row->po_qty }}" readonly></td>
                 <td>
                <input class="form-control" name="items[{{ $index }}][rec_qty]" type="number"
                            value="{{ $row->po_qty }}">
                        <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                    </td>
                    <td>
                        <input class="form-control" name="items[{{ $index }}][rec_weight]" type="number"
                                    value="">
                                <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                            </td>
                            <td>
                                <input class="form-control" name="items[{{ $index }}][expiry_date]" type="date"
                                            value="">
                                        <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                                    </td>
                            <td>
                                <input class="form-control" name="items[{{ $index }}][batch_no]" type="string"
                                            value="">
                                         <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />  
                                    </td>
                                    
                    
                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
