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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->stock_item->stock_number }}</td>
                        <td>{{ $row->stock_item->description }}</td>
                        <td>{{ $row->stock_item->unit }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->unit_price }}</td>
                        <td><input name="items[{{ $index }}][creditQty]" max="{{ $row->quantity }}" id="items{{ $index }}creditQty"
                                onchange="onCreditQtyChange({{ $row->id }})" class="form-control" type="number"
                                value="{{ $row->quantity }}"></td>

                        <td><input name="items[{{ $index }}][saleValue]" id="items{{ $index }}saleValue" readonly class="form-control" type="number">
                        </td>
                        <td><input name="items[{{ $index }}][vatAmount]" id="items{{ $index }}vatAmount" readonly class="form-control" type="number">
                        </td>
                        <td><input name="items[{{ $index }}][totalValue]" id="items{{ $index }}totalValue" readonly class="form-control"
                                type="number">
                        </td>
                        <input type="hidden" name="items[{{ $index }}][stock_item_id]"
                        value="{{ $row->stock_item->id }}" />
                        <input type="hidden" name="items[{{ $index }}][stock_item_number]"
                        value="{{ $row->stock_item->stock_number }}" />
                        <input type="hidden" name="items[{{ $index }}][stock_item_qty]"
                        value="{{ $row->quantity }}" />
                        <input type="hidden" name="items[{{ $index }}][stock_item_unit_price]"
                        value="{{ $row->unit_price }}" />
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <div class="row">
            <div class="form-group col-md-2">
                <label>Grand Total :</label>
                <br>
                <input style="background-color:palevioletred" id="grandTotal" name="grand_total" readonly class="form-control"
                    type="number" value="0">
            </div>
        </div>

        <script>
            let mrsList = <?php echo json_encode($mrs_list ?? []); ?>;
            $(document).ready(function() {
                mrsList?.map((row,index) =>{
                    const value = row?.quantity
                    const option = row?.material_return?.invoice?.option
                    const itemTotal = parseFloat(value) * parseFloat(row?.unit_price);
                const {salesValue, total, vatAmount} = calculateAmounts(option, itemTotal)


                $(`#items${index}saleValue`).val(salesValue)
                $(`#items${index}vatAmount`).val(vatAmount)
                $(`#items${index}totalValue`).val(total)
                })
                getGrandTotal()
            });



            function onCreditQtyChange(id) {
                const index = mrsList?.findIndex(row => row.id == id)
                const mrsData = mrsList?.find(row => row.id == id)


                const value = $(`#items${index}creditQty`).val()
                const option = mrsData?.material_return?.invoice?.option
                const itemTotal = parseFloat(value) * parseFloat(mrsData?.unit_price);
                const {salesValue, total, vatAmount} = calculateAmounts(option, itemTotal)


                $(`#items${index}saleValue`).val(salesValue)
                $(`#items${index}vatAmount`).val(vatAmount)
                $(`#items${index}totalValue`).val(total)
                getGrandTotal()
            }

            function calculateAmounts(option, itemTotal){
                let salesValue = 0;
                let vatAmount = 0;
                let total = 0;
                console.log({itemTotal})
                console.log({option})
                if(option == 0){
                    salesValue = itemTotal;
                    total =itemTotal;
                }

                if([1,3].includes(option)){
                    salesValue = itemTotal
                    vatAmount = itemTotal * 0.18
                    total = salesValue + vatAmount
                }
                if(option == 2){
                    salesValue = itemTotal / 1.18
                    vatAmount = salesValue * 0.18
                    total = salesValue + vatAmount
                }

                return {
                    salesValue : salesValue?.toFixed(2),
                    vatAmount : vatAmount?.toFixed(2),
                    total: total?.toFixed(2),
                }
            }

            function getGrandTotal(){
                let grandTotal = 0
                mrsList?.map((row,index) =>{
                const total =$(`#items${index}totalValue`).val()
                grandTotal = grandTotal + parseFloat(total)
                })
                $(`#grandTotal`).val(grandTotal)
            }
        </script>


