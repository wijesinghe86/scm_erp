<div class="table-responsive">
    <table class="table table-bordered" id="tbl_goodsreceiveds">
        <thead>
            <tr>
                <td>From Stock Number</td>
                <td>Transfer To Stock Number</td>
                <td>Quantity</td>
                <td>Weight</td>
                <td>From Warehouse</td>
                <td>To Warehouse</td>
                <td>Justification</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $item['from_stock_item_stock_number'] }}</td>
                    <td>{{ $item['to_stock_item_stock_number'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['weight'] }}</td>
                    <td>{{ $item['from_warehouse_name'] }}</td>
                    <td>{{ $item['to_warehouse_name'] }}</td>
                    <td>{{ $item['justification'] }}</td>
                    <td>
                        <a class="btn btn-primary" onclick="removeFromTable(this,{{ $index }})">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</div>
