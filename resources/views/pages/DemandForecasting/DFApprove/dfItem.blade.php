<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>DF Qty</th>
            <th>Approved Qty</th>
            <th>Remark</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $index => $row)
            @php
                $created_qty = 0;
                $current_item_approvals = $row->approval_items->filter(function ($approval_item) use ($row) {
                    return $approval_item->item_id == $row->stock_item_id;
                });
                $created_qty = $current_item_approvals->sum('approved_qty');
                $available_qty = $row->qty - $created_qty;
            @endphp
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /><input type="hidden"></td>
                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td>{{ $available_qty }}</td>
                <td><input class="form-control" onkeyup="onItemQtyChange(this,{{ $available_qty }},{{ $index }})"
                        name="items[{{ $index }}][approved_qty]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $row->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][remarks]" type="text"
                        value="{{ $row->remark }}">
                </td>
                <td>
                    <select class="form-control" name="items[{{ $index }}][action]">
                        <option value="" selected> Select Action</option>
                        @foreach (config('scm.df_action') as $action)
                            <option value="{{ $action['id'] }}">{{ $action['name'] }}</option>
                        @endforeach
                    </select>
                </td>



                {{-- <input type="hidden" name="items[{{ $index }}][type]" value="in" /> --}}


                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
