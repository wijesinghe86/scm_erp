<table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>S/No</th>
            <th>Des</th>
            <th>U/M</th>
            <th>Credit Qty</th>
            <th>Unit Price</th>
            <th>Total Sales Value</th>
            {{-- <th>Action</th> --}}
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item_list as $index => $row)
            <tr>
                <td>
                    <input type="checkbox" name="items[{{ $index }}][is_selected]" />
                </td>
                <td>{{ $row->stockItems->stock_number }}</td>
                <td>{{ $row->stockItems->description }}</td>
                <td>{{ $row->stockItems->unit }}</td>
                <td>{{ $row->credit_qty }}</td>
                <td>{{ $row->unit_rate }}</td>
                <td>{{ $row->total_sales_value }}</td>
                <td style="display: none"><input value="{{ $row->id }}" name="items[{{ $index }}][id]" /></td>
                 <td>
                    <select class="form-control" name="items[{{ $index }}][approval_status]">
                        <option value="" disabled selected> Select Status</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </td> 
                {{-- <td><input class="form-control" name="items[{{ $index }}][remark]"></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
