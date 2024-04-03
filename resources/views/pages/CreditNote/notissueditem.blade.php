       <table class="table bordered">
            <thead>
                <tr>
                    <th style="width: 1rem"></th>
                    <th style="width: 1rem">No</th>
                    <th style="width: 2rem">Stock No</th>
                    <th style="width: 0.5mm">Description</th>
                    <th style="width: 1rem">U/M</th>
                    <th style="width: 2rem">Order Qty</th>
                    <th style="width: 8rem;">Unit Rate</th>
                    <th style="width: 6rem">Credit Qty</th>
                    <th style="width: 15rem">Sales Val </th>
                    <th style="width: 10rem">Vat amount</th>
                    <th style="width: 10rem">Total Value</th>
                    <th style="width: 2rem"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($do_list as $index => $row)
                    @php

                    @endphp
                    <tr>
                        <td style="width: 1rem"><input type="checkbox" name="items[{{ $index }}][is_selected]" /></td>
                        <td style="width: 1rem">{{ $loop->iteration }}</td>
                        <td style="width: 2rem">{{ $row->stock_item->stock_number }}</td>
                        <td style="width: 0.5mm">{{ $row->stock_item->description }}</td>
                        <td style="width: 1rem">{{ $row->stock_item->unit }}</td>
                        <td style="width: 10rem">{{ $row->qty }}</td>
                        <td style="width: 10rem">{{ $row->unit_price }}</td>
                        <td style="width: 20rem; align:left;" ><input name="items[{{ $index }}][creditQty]" max="{{ $row->qty }}" id="items{{ $index }}creditQty"
                                onchange="onCreditQtyChange({{ $row->id }})" class="form-control" type="number"
                                value="{{ $row->qty }}"></td>
                                <td style="width:55rem; align:right;"><input name="items[{{ $index }}][saleValue]"  id="items{{ $index }}saleValue" readonly class="form-control" type="number">
                                </td>
                                <td style="width:50rem; align:left;"><input name="items[{{ $index }}][vatAmount]" id="items{{ $index }}vatAmount" readonly class="form-control" type="number">
                                        </td>
                                <td style="width:50rem; align:left;"><input name="items[{{ $index }}][totalValue]" id="items{{ $index }}totalValue" readonly class="form-control" type="number">
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
            <label>Grand Total(Rs.):</label>
            <br>
            <input style="background-color:palevioletred" name="grand_total" id="grandTotal" readonly class="form-control" type="number"
                                value="0">
        </div>
        </div>
        <script>
            let doList = <?php echo json_encode($do_list ?? []); ?>;
            $(document).ready(function() {
                doList?.map((row,index) =>{
                    const value = row?.qty
                    const option = row?.delivery_order?.invoice?.option
                    const itemTotal = parseFloat(value) * parseFloat(row?.unit_price);
                const {salesValue, total, vatAmount} = calculateAmounts(option, itemTotal)


                $(`#items${index}saleValue`).val(salesValue)
                $(`#items${index}vatAmount`).val(vatAmount)
                $(`#items${index}totalValue`).val(total)
                })
                getGrandTotal()
            });

           

            function onCreditQtyChange(id) {
                const index = doList?.findIndex(row => row.id == id)
                const doData = doList?.find(row => row.id == id)
               

                const value = $(`#items${index}creditQty`).val()
                const option = doData?.delivery_order?.invoice?.option
                const itemTotal = parseFloat(value) * parseFloat(doData?.unit_price);
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
                    vatAmount = itemTotal * 0.15
                    total = salesValue + vatAmount
                }
                if(option == 2){
                    salesValue = itemTotal / 1.15
                    vatAmount = salesValue * 0.15
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
                doList?.map((row,index) =>{
                const total =$(`#items${index}totalValue`).val()
                grandTotal = grandTotal + parseFloat(total)
                })
                $(`#grandTotal`).val(grandTotal)
            }
        </script>
