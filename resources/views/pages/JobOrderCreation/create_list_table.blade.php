<div class="table-responsive" >
    <table class="table bordered">
        <thead>
            <tr>
                <th></th>
                <th>S/No</th>
                <th>Des</th>
                <th>U/M</th>
                <th>PPS Available QTY</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pps_items as $index => $row)
                @php
                    $created_qty = 0;
                    $job_orders = $row->production_planing->job_orders;
                    if ($job_orders) {
                        foreach ($job_orders as $key => $job_order) {
                            $current_item_job_order_items = $job_order->items->filter(function ($job_order_item) use ($row, $created_qty) {
                                return $job_order_item->stock_id == $row->stock_item->id;
                            });
                            $created_qty = $current_item_job_order_items->sum('jo_qty');
                        }
                    }
                    $available_qty = $row->pps_qty - $created_qty;
                @endphp
                <tr>
                    <td>
                        <input type="checkbox" name="items[{{ $index }}][is_selected]" />
                    </td>
                    <td>{{ $row->stock_item->stock_number }}</td>
                    <td>{{ $row->stock_item->description }}</td>
                    <td>{{ $row->stock_item->unit }}</td>
                    <td>{{ $available_qty }}</td>
                    <td>
                        <input style="width:10rem" class="form-control" value="{{ $available_qty }}"
                            onkeyup="onItemQtyChange(this,{{ $available_qty }},{{ $index }})"
                            id="items[{{ $index }}][jo_qty]" name="items[{{ $index }}][jo_qty]"
                            type="number">
                        <input type="hidden" name="items[{{ $index }}][item_id]"
                            value="{{ $row->stock_item->id }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
