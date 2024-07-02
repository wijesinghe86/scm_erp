<br>
<br>
<div class="table-responsive">
    <table class="table  table-bordered form-group">
        <thead>
            <tr>
                <th>RMI Stock No</th>
                <th>Description</th>
                <th style="min-width: 150px; width: 150px;">Issued Serial No</th>
                <th style="min-width: 100px; width: 100px;">Issued Weight</th>
                <td>
                    <table class="table">
                        <tr>
                            <th align="center" colspan="5">Finished Product</th>
                        <tr>
                            <th style="min-width: 150px; width: 150px;">Stock No</th>
                            <th style="min-width: 150px; width: 150px;">Description</th>

                            <th style="min-width: 100px; width: 100px;">Production Qty</th>
                            <th style="min-width: 100px; width: 100px;">Production Weight</th>
                            <th style="min-width: 130px; width: 130px;">Batch No</th>
                            <th style="min-width: 200px; width: 200px;"></th>
                        </tr>
            </tr>
    </table>
    </td>
    </tr>
    </thead>
    <tbody>
        @if (is_array($finish_good_items))
            @foreach (collect($finish_good_items)->groupBy('batch_no') as $batch_no => $items)
                <tr>
                    <td class="align-top">{{ data_get($items[0], 'rmi_item_stock_number') }}</td>
                    <td class="align-top">{{ data_get($items[0], 'rmi_item_stock_description') }}</td>
                    <td colspan="2">
                        <table class="table">
                            @foreach (collect($items)->groupBy('semi_product_serial_no') as $semi_product_serial_no => $items)
                                <tr>
                                    <td style="min-width: 150px; width: 150px;" class="align-top">
                                        {{ $semi_product_serial_no }}</td>
                                    <td style="min-width: 150px; width: 150px;" class="align-top">
                                        {{ $items[0]['each_qty'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    <td>
                        {{-- <td colspan="5"> --}}
                        <table class="table table-striped">
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td style="min-width: 150px; width: 150px;" class="align-top">
                                        {{ $item['pro_stock_no'] }}</td>
                                    <td style="min-width: 150px; width: 150px;" class="align-top">
                                        {{ $item['pro_description'] }}</td>
                                    <td style="min-width: 100px; width: 100px;" class="align-top">
                                        {{ $item['pro_qty'] }}</td>
                                    <td style="min-width: 100px; width: 100px;" class="align-top">
                                        {{ $item['pro_weight'] }}</td>
                                    <td align="right" style="min-width: 100px; width: 100px;" class="align-top">
                                        {{ $item['batch_no'] }}</td>
                                        <td align="right" style="min-width: 200px; width: 200px;">
                                            <a onclick="removeFromFinishGoodTable(this,`<?php echo $item['batch_no']; ?>`)"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                </tr>
                            @endforeach
                        </table>
                        {{-- </td> --}}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    </table>
</div>
