<br>
<br>
<div class="table-responsive">
    <table class="table table-bordered form-group">
        <thead>
            <tr>
                {{-- <th></th> --}}
                <th colspan="2">
                    <table class="table">
                        <tr>
                            <td align="center" colspan="2">Finished Products</td>
                        </tr>
                        <tr>
                            <td>Stock No</td>
                            <td>Description</td>
                        </tr>
                    </table>
                </th>
                <th>U/M</th>
                <th>Serial No</th>
                <th>Production Qty</th>
                <th>Production Weight</th>
                <th>Batch No</th>
                <th colspan="3">
                    <table class="table">
                        <tr>
                            <td align="center" colspan="3">Dispatching</td>
                        </tr>
                        <tr>
                            <td>Dispatch Qty</td>
                            <td>Dispatch Weight</td>
                            <td>Dispatch To</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    {{-- <td><input type="checkbox" name="items[{{ $index }}][is_selected]"></td> --}}
                    <td>
                        {{ $item->stock_item->stock_number }}
                        <input type="hidden" name="items[{{ $index }}][fgrn_item_id]" value="{{ $item->id }}" />
                        <input type="hidden" name="items[{{ $index }}][stock_item_id]" value="{{ $item->stock_item->id }}" />
                    </td>
                    <td>{{ $item->stock_item->description }}</td>
                    <td>{{ $item->stock_item->unit }}</td>
                    <td>{{ $item->semi_product_serial_no }}</td>
                    <td>{{ $item->pro_qty }}</td>
                    <td>{{ $item->pro_weight }}</td>
                    <td>{{ $item->batch_no }}</td>
                    <td>
                        <input required type="number" class="form-control"
                            name="items[{{ $index }}][dispatch_qty]" value="{{ $item->pro_qty }}"
                            id="items[{{ $index }}][dispatch_qty]">
                    </td>
                    <td>
                        <input required type="number" class="form-control"
                            name="items[{{ $index }}][dispatch_weight]" value="{{ $item->pro_weight }}"
                            id="items[{{ $index }}][dispatch_weight]">
                    </td>
                    <td style="width: 200px;">
                        <select required class="form-control item-select"
                            name="items[{{ $index }}][dispatch_to]"
                            id="items[{{ $index }}][dispatch_to]">
                            <option value="">Select Warehouse</option>

                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<hr>
