{{-- @php
    logger($lists);
@endphp --}}

<div class="table-responsive">
    <table class="table bordered form-group">

        <thead>
            <tr>
                <th></th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Issue Qty</th>
                <th>Invoice Qty</th>
                <th>Unit Rate</th>
                <th>Item Amount</th>
                <th>Discount</th>
                <th>Item Total</th>
                <th>Location</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $index => $row)
                <tr>
                    <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>

                    <td>{{optional(optional($row)->item)->stock_number }}</td>
                    <td>{{ $row->item->description }}</td>
                    <td>{{ $row->item->unit }}</td>
                    <td><input class="form-control" type="number" value="{{ $row->issued_qty }}" readonly></td>
                    <td>

                    <input  class="form-control"
                            id="qty-{{ $index }}" name="items[{{ $index }}][invoice_qty]" type="number"
                            value="{{ $row->issued_qty }}">
                        <input type="hidden" name="items[{{ $index }}][item_id]"value="{{ $row->item->id }}" />

                    <td>
                        <input  class="form-control"
                            id="price-{{ $index }}" name="items[{{ $index }}][Unit Price]"
                            type="number" onchange="calculateUnitPrice(this,{{ $index }})">
                        <input type="hidden" name="items[{{ $index }}][item_id]"
                            value="{{ $row->item->id }}" />
                    </td>
                    <td>
                        <input class="form-control" name="items[{{ $index }}][weight]" type="number">
                        <input type="hidden" name="items[{{ $index }}][item_id]"
                            value="{{ $row->item->id }}" />
                    </td>
                    <td>
                        <input onclick="Invvalue(this,{{ $index }})" class="form-control"
                            name="items[{{ $index }}][Value]" type="number" id="total-{{ $index }}">
                        <input type="hidden" name="items[{{ $index }}][item_id]"
                            value="{{ $row->item->id }}" />
                    </td>




                </tr>
            @endforeach
        </tbody>
    </table>
</div>

