<table class="table table-bordered">
    <thead>
        <tr>
           <th>#</th>
            <th>Serial Code</th>
            <th>Supplier Code</th>
            <th>Qty</th>
            <th></th>
            </tr>
    </thead>
        <tbody>
            @foreach($lists as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->serial_no}}</td>
                <td>{{$row->supplier_code}}</td>
                <td>{{$row->qty}}</td>
                {{-- <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="onDeleteSerialCode('{{$row->id}}')">Delete</button>
                </td> --}}
            </tr>
            @endforeach

        </tbody>
</table>
