<table class="table bordered form-group">
    <thead>
        <tr>
            <th>Raw S/N</th>
            <th>Raw Des</th>
            <th>Raw Serial No</th>
            <th>Semi Pro S/N</th>
            <th>Semi Pro Des</th>
            <th>Semi Pro Qty </th>
            <th>Semi Pro Weight</th>
            <th>Semi Serial No</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (is_array($items))
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $item['stock_no'] }}</td>
                    <td>{{ $item['raw_description'] }}</td>
                    <td>{{ $item['serial'] }}</td>
                    <td>{{ $item['stockNo'] }}</td>
                    <td>{{ $item['semi_description'] }}</td>
                    <td>{{ $item['semi_qty'] }}</td>
                    <td>{{ $item['semi_weight'] }}</td>
                    <td>{{ $item['semi_serial_no'] }}</td>
                    <td><a onclick="onRemoveItemClick(this,{{$index}})" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
