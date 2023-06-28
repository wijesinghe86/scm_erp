<table class="table bordered form-group">
    <thead>
        <tr>
            <th>Jo Item S/N</th>
            <th>Jo Item Des</th>
            <th>Raw S/N</th>
            <th>Raw Des</th>
            <th>Raw Qty</th>
            <th>Raw Weight</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (is_array($items))
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $item['jo_stock_no'] }}</td>
                    <td>{{ $item['jo_description'] }}</td>
                    <td>{{ $item['raw_material_stock_no'] }}</td>
                    <td>{{ $item['raw_material_description'] }}</td>
                    <td>{{ $item['req_qty'] }}</td>
                    <td>{{ $item['req_weight'] }}</td>
                    <td><a onclick="onRemoveItemClick(this,{{ $index }})" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
