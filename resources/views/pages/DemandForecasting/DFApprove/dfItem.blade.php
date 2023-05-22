<table class="table bordered">
    <thead>
        <tr>
           <th></th>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>DF Qty</th>
            <th>Approved Qty</th>
            <th>Remark</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $index=>$row )
            <tr>
                <td><input type="checkbox" name="items[{{ $index }}][is_selected]" /><input type="hidden"></td>
                <td>{{ $row->item->stock_number }}</td>
                <td>{{ $row->item->description }}</td>
                <td>{{ $row->item->unit }}</td>
                <td>{{ $row->qty }}</td>
                <td><input class="form-control" name = "items[{{ $index }}][approved_qty]" type="number" >
                <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                </td>
                <td>
                    <input class="form-control" name = "items[{{ $index }}][remarks]" type="text" value="{{ $row->remark }}">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                    </td>
                    <td>
                        <select class="form-control" name="items[{{ $index }}][action]" >
                            <option value="" selected> Select Action</option>
                            @foreach(config('scm.df_action') as $action)
                            <option value="{{$action['id']}}">{{$action['name']}}</option>
                            @endforeach
                        </select>
                    </td>



                {{-- <input type="hidden" name="items[{{ $index }}][type]" value="in" /> --}}


                {{-- <td><a href="{{ route('purchase_request.delete_item', $index) }}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
