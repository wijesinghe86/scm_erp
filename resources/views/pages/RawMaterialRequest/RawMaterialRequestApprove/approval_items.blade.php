<div class="table-responsive" >
    <table class="table table-striped">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Jo S/No</th>
            <th scope="col">Jo Description</th>
            <th scope="col">Jo Qty</th>
            <th scope="col">Rmr items</th>
        </tr>
        @foreach ($items->groupBy('jo_stock_no') as $key => $material_request_items)
            <tr>
                <td class="align-top">{{ $loop->iteration }}</td>
                <td class="align-top">{{ $material_request_items[0]['job_order_item']['stock_item']['stock_number'] }}
                </td>
                <td class="align-top">{{ $material_request_items[0]['job_order_item']['stock_item']['description'] }}
                </td>
                <td class="align-top">{{ $material_request_items[0]['job_order_item']['jo_qty'] }}
                </td>
                <td>
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rmr S/No</th>
                            <th scope="col">Rmr Descrition</th>
                            <th scope="col">Rmr Qty</th>
                            <th scope="col">Rmr Weight</th>
                            <th scope="col">Approve qty</th>
                            <th scope="col">Approve weight</th>
                            <th scope="col">Justification</th>
                        </tr>
                        @foreach ($material_request_items as $index => $material_request_item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $material_request_item->stock_item->stock_number }}</td>
                                <td>{{ $material_request_item->stock_item->description }}</td>
                                <td>{{ $material_request_item->req_qty }}</td>
                                <td>{{ $material_request_item->req_weight }}</td>
                                <td>
                                    <input required type="number" class="form-control"
                                        name="items[{{ $material_request_item->id }}][approved_qty]">
                                    <input type="hidden" class="form-control" value="{{ $material_request_item->id }}"
                                        name="items[{{ $material_request_item->id }}][rmr_item_id]">
                                    <input type="hidden" class="form-control"
                                        value="{{ $material_request_item->job_order_item->job_order_id }}"
                                        name="items[{{ $material_request_item->id }}][jo_order_id]">
                                    <input type="hidden" class="form-control"
                                        value="{{ $material_request_item->job_order_item->id }}"
                                        name="items[{{ $material_request_item->id }}][jo_order_item_id]">

                                </td>
                                <td>
                                    <input required type="number" class="form-control"
                                        name="items[{{ $material_request_item->id }}][approved_weight]">
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="items[{{ $material_request_item->id }}][justification]">
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
    </table>
</div>
