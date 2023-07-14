<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>S/No</th>
            <th>Des</th>
            <th>U/M</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Remark</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pps_items as $index => $row)
            <tr>
                <td>
                    <input type="checkbox" name="items[{{ $index }}][is_selected]" />
                </td>
                <td>{{ $row->stock_item->stock_number }}</td>
                <td>{{ $row->stock_item->description }}</td>
                <td>{{ $row->stock_item->unit }}</td>
                <td>{{ $row->pps_qty }}</td>
                <td style="display: none"><input value="{{ $row->id }}" name="items[{{ $index }}][id]" /></td>
                <td>
                    <select class="form-control" name="items[{{ $index }}][approval_status]">
                        <option value="" disabled selected> Select Status</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </td>
                <td><input class="form-control" name="items[{{ $index }}][remark]"></td>
            </tr>
        @endforeach
    </tbody>
</table>
