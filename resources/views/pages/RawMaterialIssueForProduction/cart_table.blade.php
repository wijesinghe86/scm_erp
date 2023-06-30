<table class="table bordered form-group">
    <thead>
        <tr>
            <th>No</th>
            <th>Req Item</th>
            <th>Req Qty</th>
            <th>Raw Weight</th>
            <th>Items</th>
            
        </tr>
    </thead>
    <tbody>
        @if (is_array($items))
            @foreach (collect($items)->groupBy('req_item_stock_number') as $req_item_stock_number => $items)
                <tr>
                    <td class="align-top">{{ $loop->iteration }}</td>
                    <td class="align-top">{{ $req_item_stock_number }}</td>
                    <td class="align-top">{{ $items[0]['req_item_qty'] }}</td>
                    <td class="align-top">{{ $items[0]['req_item_weight'] }}</td>
                    <td>
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Issued Serials</th>
                                    <th>Qty</th>
                                    <th>Weight</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $item['semi_product_serial_no'] }}</td>
                                        <td>{{ $item['semi_product_qty'] }}</td>
                                        <td>{{ $item['semi_product_weight'] }}</td>
                                        <td>{{ $item['remarks'] }}</td>
                                        <td><a onclick="onRemoveItemClick(this,{{ $item['semi_product_item_id'] }})"
                                                class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
