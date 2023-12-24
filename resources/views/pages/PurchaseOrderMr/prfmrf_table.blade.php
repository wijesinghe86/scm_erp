<div class="table-responsive">
    <table class="table bordered form-group">
        
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
                    {{-- <input id="qty-{{ $index }}" onkeyup="qtyfunc(this)" class="form-control" name="items[{{ $index }}][po_qty]" type="number"
                        value="{{ $row->prfqty }}"> --}}
                        <input oninput="onChangeQty(this,{{ $index }})" class="form-control" id="qty-{{ $index }}"
                        name="items[{{ $index }}][po_qty]" type="number" value="{{ $row->prfqty }}">
                <input type="hidden" name="items[{{ $index }}][item_id]"value="{{ $row->item->id }}" />

                <td>
                    <input class="form-control" name="items[{{ $index }}][weight]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>

                <td>
                    <input oninput="onChangePrice(this,{{ $index }})" class="form-control"  id="price-{{ $index }}" name="items[{{ $index }}][Unit Price]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][Value]" type="number" id="total-{{ $index }}" >
                     <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" /> 
                </td>
            

                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
        <td colspan="8">Total Value</td>
        <td id="total"></td>
    </tfoot> --}}
</table>
</div>



