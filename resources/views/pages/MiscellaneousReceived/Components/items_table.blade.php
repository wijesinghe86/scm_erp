<div class="content table-responsive table-full-width">
    <table class="table table-success" id="invoices-table">
        <thead>
            <tr>
                <th>I/No</th>
                <th>Stock No</th>
                <th>Description</th>
                <th>U/M</th>
                <th>Revd Qty</th>
                <th>Revd Weight</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->stock_no }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->rec_qty }}</td>
                    <td>{{ $item->rec_weight }}</td>
                    <td>{{ $item->location ? $item->location->warehouse_name : 'N/A' }}</td>
                    {{-- <td>
                        <a href="">
                            <i class="mdi mdi-pencil text-dark"></i>
                        </a>
                        <a href="">
                            <i class="mdi mdi-delete text-danger"></i>
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

