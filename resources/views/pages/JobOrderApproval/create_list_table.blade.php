<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>S/No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Quantity</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($job_order_items as $index => $row)
            <tr>
                <td>
                    <input type="checkbox" name="items[{{ $index }}][is_selected]" />
                </td>
                <td>{{ $row->stock_item->stock_number }}</td>
                <td>{{ $row->stock_item->description }}</td>
                <td>{{ $row->stock_item->unit }}</td>
                <td>{{ $row->jo_qty }}</td>
                <td style="display: none"><input value="{{ $row->id }}" name="items[{{ $index }}][id]" /></td>
                <td>
                    <select class="form-control" name="items[{{ $index }}][approval_status]">
                        <option value="" disabled selected> Select Status</option>
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
