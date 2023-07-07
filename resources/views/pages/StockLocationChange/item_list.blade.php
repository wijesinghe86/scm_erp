{{-- Invoice Items table Start here --}}
<div class="content table-responsive table-full-width">
    <table class="table table-bordered" id="invoices-table">
        <thead>
            <tr>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Issue Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (is_array($items))
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $item['stock_number'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['uom'] }}</td>
                        <td>{{ $item['issue_qty'] }}</td>
                        <td><button type="button" onclick="onRemoveclick(this,{{ $index }})"
                                class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<br>
<hr>
<br>
{{-- Invoice Items table End here --}}
