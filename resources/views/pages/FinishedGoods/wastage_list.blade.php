<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Qty</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wastage_items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['wastage_stock_number'] }}</td>
                    <td>{{ $item['wastage_description'] }}</td>
                    <td>{{ $item['wastage_uom'] }}</td>
                    <td>{{ $item['wastage_qty'] }}</td>
                    <td align="right" style="min-width: 200px; width: 200px;">
                        <a onclick="removeFromWastageTable(this,{{ $index }})"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
