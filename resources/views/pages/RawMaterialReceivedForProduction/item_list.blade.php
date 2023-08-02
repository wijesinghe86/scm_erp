<div class="table-responsive">
    <table class="table bordered form-group">
        <thead>
            <tr>
                <th></th>
                <th>No</th>
                <th>isseued Item (Serial | SN | Description)</th>
                <th>isseued Qty</th>
                <th>isseued Weight</th>
                <th>Recived Weight</th>
                <th>Recived Qty</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->semi_product_serial_no }} |
                        {{ optional(optional(optional($item)->semi_product_item)->semi_product_stock_item)->stock_number }}
                        |
                        {{ optional(optional(optional($item)->semi_product_item)->semi_product_stock_item)->description }}
                    </td>
                    <td>{{ $item->semi_product_qty }}</td>
                    <td>{{ $item->semi_product_weight }}</td>
                    <td>
                        <input readonly style="width: 10rem" type="number" value="{{ $item->semi_product_qty }}" required
                            class="form-control" name="items[{{ $index }}][received_qty]" />
                    </td>
                    <td>
                        <input readonly style="width: 10rem" type="number" value="{{ $item->semi_product_qty }}"
                            required class="form-control" name="items[{{ $index }}][received_qty]" />
                        <input type="hidden" class="form-control" name="items[{{ $index }}][stock_item_no]"
                            value="{{ optional(optional(optional($item)->semi_product_item)->semi_product_stock_item)->id }}" />
                        <input type="hidden" class="form-control" name="items[{{ $index }}][serial_no]"
                            value="{{ $item->semi_product_serial_no }}" />
                    </td>
                    <td>
                        <input style="width: 25rem" type="text" class="form-control"
                            name="items[{{ $index }}][remarks]" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
