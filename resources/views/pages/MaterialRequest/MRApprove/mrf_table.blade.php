<div class="table-responsive">
    <table class="table bordered form-group">
        <table class="table bordered">
    <thead>
        <tr>
            <th></th>
            <th>S/No</th>
            <th>Des</th>
            <th>U/M</th>
            <th>Priority</th>
            <th>Requested Qty</th>
            <th>Rem Qty</th>
            <th>Approved Qty</th>
            <th>Status</th>
            <th>Approved For</th>
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
                <td>{{ $row->priority }}</td>
                <td><input class="form-control" type="number" value="{{ $row->mrf_qty }}" readonly></td>
                <td>{{ $row->remaining_qty }}</td>
                <td>
                    <input class="form-control" name="items[{{ $index }}][qty]" type="number"
                        value="{{ $row->remaining_qty }}" max="{{$row->remaining_qty}}">
                    <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $row->item->id }}" />
                    <input type="hidden" name="items[{{ $index }}][mr_item_id]" value="{{ $row->id }}" />
                </td>

                <td>
                    <select class="form-control" name="items[{{ $index }}][status]" >
                        <option value="" selected> Select Status</option>
                        @foreach(config('scm.mr_status') as $status)
                        <option value="{{$status['id']}}">{{$status['name']}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="items[{{ $index }}][approved_for]" >
                        <option value="" selected> Select Approved For</option>
                        @foreach(config('scm.mr_actions') as $status)
                        <option value="{{$status['id']}}">{{$status['name']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
