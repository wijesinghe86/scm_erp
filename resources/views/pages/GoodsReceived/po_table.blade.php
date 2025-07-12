<div class="table-responsive">
    <table class="table bordered form-group">
<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Approved PO Quantity</th>
            <th>Remaining Receivable Qty</th>
            <th>Received Quantity</th>
            <th>Received Weight</th>
            <th>Exp Date</th>
            <th>Batch Number</th>
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
                <td>{{ $row->po_qty }}</td>
                <td><input class="form-control" type="number" value="{{ $row->remaining_qty }}" id="remaining_qty-{{ $index }}"readonly></td>

                 <td>
                <input oninput="onChangeQty(this,{{ $index }})" class="form-control" name="items[{{ $index }}][rec_qty]" type="number" id="qty-{{ $index }}"
                            value="{{ $row->remaining_qty }}">
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
