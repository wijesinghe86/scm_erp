<table class="table bordered">
    <thead>
        <tr>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Rec Qty</th>
            <th>Rec Weight</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $row)
            <tr>
                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td>{{ $row->rec_qty }}</td>
                <td>{{ $row->rec_weight }}</td>
                <td>
                    <button type="button" class="btn btn-primary"
                        onclick="onClickAssigncode('{{ $row->id }}','{{ $row->item->stock_number }}')">Add Raw
                        Material Code
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</form>
</div>
</div>
</div>
</td>
