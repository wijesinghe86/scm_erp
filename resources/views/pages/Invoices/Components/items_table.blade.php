<div class="content table-responsive table-full-width">
    <table class="table table-success" id="invoices-table">
        <thead>
            <tr>
                <th>I/No</th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Order Qty</th>
                <th>Unit Rate (Rs.)</th>
                <th>Discount</th>
                <th>Item Amount</th>
                <th>Item Total</th>
                <th>Location</th>
                <th align="right" >Action</th>
            </tr>
        </thead>
        <tbody class="table-warning" >
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->stock_no }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->item_discount_percentage }}</td>
                    <td>{{ $item->item_discount_amount }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->location ? $item->location->warehouse_name : 'N/A' }}</td>
                    <td align="right" >
                        <a onclick="removeFromCart({{$item}})" class="h4 cursor-pointer" style="cursor: pointer;" >
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
