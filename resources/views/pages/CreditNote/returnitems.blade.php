<div class="table-responsive">
    <table class="table bordered form-group">
<table class="table bordered">
    <thead>
        <tr>
            <th></th> 
            <th>No</th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Order Qty</th>
            <th>Unit Rate</th>
            <th>Credit Qty</th>
            <th>Sales Val </th>
            <th>Vat amount</th>
            <th>Total Value</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mrs_list as $index => $row)
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>
                <td>{{$loop->iteration}}</td>
                <td>{{ $row->stock_item->stock_number }}</td>
                <td>{{ $row->stock_item->description }}</td>
                <td>{{ $row->stock_item->unit }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->unit_price }}</td>
<td><input class="form-control" type="number" value="{{ $row->quantity }}"></td>
 


@endforeach
</tbody>
</table>
