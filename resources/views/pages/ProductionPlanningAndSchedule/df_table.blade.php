<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>DF Qty</th>
            <th>PPS Qty</th>
            <th> Weight</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $index => $row)
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /><input type="hidden"></td>
                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td>{{ $row->approved_qty }}</td>
                <td><input class="form-control"
                        onkeyup="onItemQtyChange(this,{{ $row->approved_qty }},{{ $index }})" name="items[{{ $index }}][pps_qty]"
                        type="number" value="{{ $row->qty }}">
                </td>
                <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                {{-- <input type="hidden" name="items[{{ $index }}][type]" value="in" /> --}}
                </td>
                <td><input class="form-control"name="items[{{ $index }}][weight]" type="number">
                    {{-- <input type="hidden" name="weight" value="weight" /> --}}
                </td>




                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
