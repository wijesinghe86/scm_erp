<div class="content table-responsive table-full-width">
    <table class="table table-success" id="invoices-table">
        <thead>
            <tr>
                <th>I/No</th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Order Qty</th>
                <th>Weight</th>
                <th>Unit Rate(Rs.)</th>
                <th>Item Amount(Rs.)</th>
                <th>Discount(Rs.)</th>
                <th>Item Total(Rs.)</th>
                <th>Location</th>
                <th align="right">Action</th>
            </tr>
        </thead>
        <tbody class="table-warning">
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->attributes->stock_no }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->attributes->uom }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->weight }}</td>
                    <td>{{ money($item->price) }}</td>
                    <td>{{ money($item->attributes->sub_total) }}</td>
                    <td>{{ money($item->attributes->item_discount_amount) }}</td>
                    <td>{{ money($item->attributes->total) }}</td>
                    <td>{{ $item->attributes->warehouse_name }}</td>
                    <td align="right">
                        <a onclick="removeFromCart({{ $item }})" class="h4 cursor-pointer"
                            style="cursor: pointer;">
                            <i class="mdi mdi-delete text-danger"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<hr>
<br>
