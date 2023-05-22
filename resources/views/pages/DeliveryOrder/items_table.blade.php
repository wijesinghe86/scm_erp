<div class="content table-responsive table-full-width">
    <table class="table table-success">
        <thead>
            <tr>
                <th>I/No</th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Order Qty</th>
                <th>Issue Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoiceitems as $index => $row)
                <tr>
                    <td><input type="checkbox" name="items[{{ $index }}][is_selected]"></td>
                    <td>{{ $row->stock_no }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->uom }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td><input class="form-control" type="number" value="{{ $row->quantity }}" readonly></td>
                    <td>
                        <input class="form-control" name="items[{{ $key }}][issued_qty]" type="number" value="{{ $row->quantity }}">
                        <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
