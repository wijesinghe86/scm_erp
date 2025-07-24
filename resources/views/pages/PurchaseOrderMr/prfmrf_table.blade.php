
<div class="table-responsive">
    <table class="table bordered form-group">

    <thead>
        <tr>
            <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Requested Qty</th>
            <th>Remaining Orderable Qty</th>
            <th>Orderable Qty</th>
            <th>Unit Price</th>
            <th>Weight</th>
            <th>Value</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $index => $row)
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>

                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td style="width: 10mm" >{{ $row->prfqty }}</td>
                <td><input class="form-control" type="number" value="{{ $row->remaining_qty }}" id="remaining_qty-{{ $index }}" readonly></td>
                <td style="width: 10mm">
                    {{-- <input id="qty-{{ $index }}" onkeyup="qtyfunc(this)" class="form-control" name="items[{{ $index }}][po_qty]" type="number"
                        value="{{ $row->prfqty }}"> --}}
                        <input oninput="onChangeQty(this,{{ $index }})" class="form-control" id="qty-{{ $index }}"
                        name="items[{{ $index }}][po_qty]" type="number" value="{{ $row->remaining_qty}}">
                <input type="hidden" name="items[{{ $index }}][item_id]"value="{{ $row->item->id }}" />

                <td>
                    <input oninput="onChangePrice(this,{{ $index }})" class="form-control"  id="price-{{ $index }}" name="items[{{ $index }}][Unit Price]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][weight]" type="number">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input  onclick="povalue(this,{{ $index }})" class="form-control" name="items[{{ $index }}][Value]" type="number" id="total-{{ $index }}" >
                     <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>


                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
        <tr>
            <td colspan="9" class="text-end"><strong>Total PO Value</strong></td>
            <td><input type="number" class="form-control" id="table_po_value" value="0" readonly></td>
            <td></td>
        </tr>
    </tfoot> --}}
</table>
</div>



{{-- <script>
function updateTotalPOValue() {
    let total = 0;
    $("input[id^='total-']").each(function() {
        let val = parseFloat($(this).val());
        if (!isNaN(val)) total += val;
    });
    $('#table_po_value').val(total);
    // Also update the main form's PO Value field if it exists
    if ($('#po_value').length) {
        $('#po_value').val(total);
    }
}
$(document).on('input', "input[id^='total-']", updateTotalPOValue);
$(document).ready(updateTotalPOValue);
</script> --}}



