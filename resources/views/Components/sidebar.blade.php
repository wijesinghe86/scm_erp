<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        {{-- Master --}}
        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Sales User|Sales Admin|Production
            User|Production Admin|Factory Warehouse User|Factory Admin|Executive User|Procurement User')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-master" aria-expanded="false"
                    aria-controls="ui-master">
                    <span class="menu-title">Master</span>
                    <!-- <i class="menu-arrow"></i> -->
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-master">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production
                            Admin|Factory Warehouse User|Factory Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('stockitem.all') }}">Stock Item</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Sales User|Sales Admin|Executive
                            User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('customer.index') }}">Customer</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Procurement User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('supplier.all') }}">Supplier</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('department.index') }}">Department</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('section.index') }}">Section</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production
                            Admin|Factory Warehouse User|Factory Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('fleetregistration.index') }}">Fleet
                                    Registration</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('employee.all') }}">Employee</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('taxcreation.index') }}">TaxCreation</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production
                            Admin|Factory Warehouse User|Factory Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('PlantRegistration.index') }}">Plant
                                    Registration</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production
                            Admin|Factory Warehouse User|Factory Admin')
                            <li class="nav-item"> <a
                                    class="nav-link"href="{{ route('equipmentregistration.index') }}">EquipmentRegistration</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production
                            Admin|Factory Warehouse User|Factory Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('warehouse.index') }}">Warehouse</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('locationbaydesign.index') }}">Location
                                    Bay Design</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('locationrowdesign.index') }}">Location
                                    Row Design</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('locationrackdesign.index') }}">Location
                                    Rack Design</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('locationshelfdesign.index') }}">Location
                                    Shelf Design</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        @endhasanyrole
                        {{-- <li class="nav-item"> <a class="nav-link" href="">Users</a></li> --}}
                    </ul>
                </div>
            </li>
        @endhasanyrole

        {{-- Material Request --}}
        @hasanyrole('Super Admin|Admin|Factory Warehouse User|Factory Admin|Production User|Production Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#mr-request" aria-expanded="false"
                    aria-controls="mr-request">
                    <span class="menu-title">Material Request</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="mr-request">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Factory Warehouse User|Factory Admin|Production User|Production
                            Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('material_request.index') }}">Material
                                    Request Form</a>
                            @endhasanyrole
                            @hasanyrole('Super Admin|Admin|Factory Warehouse User|Factory Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('mr_request_approve.index') }}">Material
                                    Request Approval</a>
                            @endhasanyrole
                            @hasanyrole('Super Admin|Admin|Production User|Factory Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('raw_material_request.index') }}">Raw
                                    Material Request<br> Form</a>
                            @endhasanyrole
                            @hasanyrole('Super Admin|Admin|Production Admin|Factory Admin')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('raw_material_request_approve.index') }}">Raw Material
                                    Request <br>Approve Form</a>
                            @endhasanyrole
                        </li>
                    </ul>
                </div>
            </li>
        @endhasanyrole

        {{-- Procurement --}}
        @hasanyrole('Super Admin|Admin|Procurement User')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-procurement" aria-expanded="false"
                    aria-controls="ui-procurement">
                    <span class="menu-title">Procurement</span>
                    {{-- <i class="fa-solid fa-scale-balanced"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-procurement">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Procurement User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('mrfprf.index') }}">Procurement
                                    Request</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Procurement User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('pr_request_approve.index') }}">Procurement
                                    Request<br> Approve</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Procurement User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('purchase_order_mr.index') }}">Purchase
                                    Order</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Procurement User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('purchase_order_approve.index') }}">Purchase
                                    Order Approval</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('purchase_request.index') }}">Sundry
                                    Procurement
                                    <br>Request-Optional</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('purchase_order.index') }}">Sundry
                                    Purchase
                                    <br>Order-Optional</a></li>
                        @endhasanyrole

                    </ul>
                </div>
            </li>
        @endhasanyrole
        {{-- Sales and Marketing --}}
        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin|Executive User')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-sale" aria-expanded="false"
                    aria-controls="ui-sale">
                    <span class="menu-title">Sales and Marketing</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-sale">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('billtypes.all') }}">Bill Type
                                    Creations</a>
                            </li>
                        @endhasanyrole
                        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('invoicesettings.all') }}">Invoice
                            Setting</a>
                    </li> --}}
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('invoices.all') }}">Invoice</a>
                            </li>
                        @endhasanyrole
                        {{-- @hasanyrole('Super Admin|Admin|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('invoices_cancel.create') }}">Invoice
                                    Cancellation</a>
                            </li>
                        @endhasanyrole --}}
                        @hasanyrole('Super Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('sales_order.index') }}">Sales
                                    Order</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Executive User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('credit_note.index') }}">Credit
                                    Note</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Executive User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('credit_note_approval.index') }}">Credit Note Approve</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Executive User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('customerpayment.index') }}">Customer
                                    Payment Update</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('creditlimtlog.index') }}">Credit Limit
                                    Log</a>
                            </li>
                        @endhasanyrole
                    </ul>
                </div>
            </li>
        @endhasanyrole
        {{-- Invoice_DeliveryOrder Reverse Process --}}
        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin|Warehouse User')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-urgent-sale" aria-expanded="false"
                    aria-controls="ui-urgent-sale">
                    <span class="menu-title">Reverse Logistics</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-urgent-sale">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin|Warehouse User')
                            <li class="nav-item"> <a class="nav-link"  href="{{ route('reverse_delivery.index') }}">Reverse
                                    Issuance</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('urgent_invoice.index') }}">Reverse
                                    Invoice</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Sales User|Sales Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('reverse_returns.new') }}">Reverse
                                    Return</a>
                            </li>
                        @endhasanyrole
                    </ul>
                </div>
            </li>
        @endhasanyrole
        {{-- Demand Forecasting --}}
        @hasanyrole('Super Admin|Admin|Production User|Production Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-df" aria-expanded="false"
                    aria-controls="ui-df">
                    <span class="menu-title">Demand Forecasting</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-df">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Production User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('demand-forecasting.index') }}">Demand
                                    Forecasting Entry</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('df_approve.index') }}">Demand
                                    Forecasting Approve</a>
                            </li>
                        @endhasanyrole
                    </ul>
                </div>
            </li>
        @endhasanyrole
        {{-- Production Planning and Scheduling --}}
        @hasanyrole('Super Admin|Admin|Production User|Production Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-pps" aria-expanded="false"
                    aria-controls="ui-pps">
                    <span class="menu-title">Production Planning and <br> Scheduling</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-pps">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin|Production User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('productionplanningandschedule.index') }}">Production Planning And <br>
                                    Schedule</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('production_planning_and_schedule_approval.index') }}">Production Planning
                                    And
                                    <br>
                                    Schedule Approval</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Job Order
                                    Creation</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('joborderapproval.index') }}">Job Order
                                    Approval</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Factory Warehouse User|Factory Admin|Production Admin|Production
                            User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('rawmaterialsserialcodeassigning.index') }}">Raw Materials Serial Code <br>
                                    Assigning</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Semi
                                    Production </a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Factory Warehouse User|Factory Admin|Production Admin')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For
                                    <br>
                                    Production</a>
                            </li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Production User')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('rawmaterial_received_for_production.index') }}">Raw Material Received For
                                    <br>
                                    Production</a>
                            </li>
                        @endhasanyrole
                        {{-- <li class="nav-item"> <a class="nav-link"
                        href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Semi Finished Goods
                        Serial <br> Code Assigning</a></li> --}}
                        {{-- <li class="nav-item"> <a class="nav-link"
                        href="{{ route('finishedgoodsserialcodeassigning.index') }}">Finished Goods Serial
                        <br>Code
                        Assigning </a></li> --}}
                        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Production
                        Wastage</a></li> --}}
                        @hasanyrole('Super Admin|Admin|Factory Warehouse User')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Dispatch</a></li>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Admin|Factory Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch_approval.index') }}">Dispatch
                                    Approval</a></li>
                        @endhasanyrole
                        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Production
                        Cost</a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Operation
                        Machanism <br>Production And Time <br>Management</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Plant
                        Time Management</a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Operation Mechanism <br>By
                        Product</a>
                </li> --}}
                    </ul>
                </div>
            </li>
        @endhasanyrole

        {{-- S Location Production --}}
        @hasanyrole('Super Admin|Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-iid" aria-expanded="false"
                    aria-controls="ui-iid">
                    <span class="menu-title">MRO Issue & Return</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-iid">
                    <ul class="nav flex-column sub-menu">
                        @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('internal_issue.index') }}">Internal
                                    Issue Entry</a></li>
                        @endhasanyrole

                        {{-- @hasanyrole('Super Admin|Admin')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('Sfgrn.index') }}">Finished Goods
                                    Entry</a></li>
                        @endhasanyrole --}}
                    </ul>
                </div>
            </li>
        @endhasanyrole


        {{-- Inventory Control --}}
        @hasanyrole('Super Admin|Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-inv" aria-expanded="false"
                    aria-controls="ui-inv">
                    <span class="menu-title">Inventory Management</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-inv">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('purchase_order.index') }}">Purchase
                        Order</a></li> --}}
                        <li class="nav-item"> <a class="nav-link" href="{{ route('obentry.index') }}">Openning
                                Balance</a></li>

                        <li class="nav-item"> <a class="nav-link" href="{{ route('goodsreceived.index') }}">Goods
                                Received</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('deliveryorders.all') }}">Delivery
                                Order</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('balanceorder.index') }}">Balance
                                Order</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('returns.all') }}">Customer Return</a>
                        </li>
            </li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('returns.approvalIndex') }}">Approved Customer
                    <br>Returns
                </a>
            </li>
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('goodsissuenote.index') }}">Goods Issue
                        Note</a></li> --}}
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('balanceorder.index') }}">Balance
                        Order</a></li> --}}
            {{-- <li class="nav-item"> <a class="nav-link"
                        href="{{ route('materialsreturnbycustomer.index') }}">Materials Return By Customer</a>
                </li> --}}
            <li class="nav-item"> <a class="nav-link" href="{{ route('stockadjustment.index') }}">Stock
                    Adjustment </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange.index') }}">Stock
                    Location Change<br> Issue</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange_approvals.index') }}">Stock
                    Location Change <br> Approval</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange_received.index') }}">Stock
                    Location Change <br> Recived</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('finishedgoods.index') }}">Finished
                    Goods</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('finished_goods_approval.index') }}">Finished
                    Goods Inspect</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('overshortanddamage.index') }}">Over
                        Short And Damage Details Creation</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('disposal.index') }}">Disposal</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('miscreceived.index') }}">Miscellaneous
                        Received </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('miscissued.index') }}">Miscellaneous
                        Issued </a></li> --}}
        </ul>
        </div>
        </li>
    @endhasanyrole
    {{-- Warehouse --}}
    @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production
        Admin|Sales User|Sales Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-inv" aria-expanded="false" aria-controls="ui-inv">
                <span class="menu-title">Warehouse</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-inv">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('purchase_order.index') }}">Purchase
                        Order</a></li> --}}
                    @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('obentry.index') }}">Openning Balance
                                Entry</a></li>
                    @endhasanyrole
                    @hasanyrole('Super Admin|Admin|Production Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('stock.index2') }}">On Hand Balance</a>
                        </li>
                    @endhasanyrole
                    {{-- @hasanyrole('Super Admin|Admin|Production Admin')
                <li class="nav-item"> <a class="nav-link" href="{{ route('stock.index1') }}">Stock Nill Item List</a></li>
                @endhasanyrole --}}
                    @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('goodsreceived.index') }}">Goods
                                Received</a></li>
                    @endhasanyrole
                    @hasanyrole('Super Admin|Admin|Warehouse User|Sales Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('deliveryorders.all') }}">Delivery
                                Order</a>
                        </li>
                    @endhasanyrole
                    @hasanyrole('Super Admin|Admin|Warehouse User|Sales User|Sales Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('balanceorder.index') }}">Balance
                                Order</a></li>
                    @endhasanyrole
                    @hasanyrole('Super Admin|Admin|Warehouse User')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('returns.all') }}">Customer Return</a></li>
            </li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('returns.approvalIndex') }}">Customer Return
                    Approval</a>
            </li>
        @endhasanyrole
        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('goodsissuenote.index') }}">Goods Issue
                        Note</a></li> --}}
        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('balanceorder.index') }}">Balance
                        Order</a></li> --}}
        {{-- <li class="nav-item"> <a class="nav-link"
                        href="{{ route('materialsreturnbycustomer.index') }}">Materials Return By Customer</a>
                </li> --}}
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('stockadjustment.index') }}">Stock
                    Adjustment </a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange.index') }}">Stock
                    Location Change</a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange_approvals.index') }}">Stock
                    Location Change <br> Approval</a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('stocklocationchange_received.index') }}">Stock
                    Location Change <br> Recived</a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin||Production
            Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('finishedgoods.index') }}">Finished
                    Goods</a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin||Production
            Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('finished_goods_approval.index') }}">Finished
                    Goods Inspect</a></li>
        @endhasanyrole
        @hasanyrole('Super Admin|Admin|Factory Warehouse User|Warehouse User|Warehouse Admin|Factory Admin')
            <li class="nav-item"> <a class="nav-link" href="{{ route('damage_return.create') }}">Damage Return</a></li>
        @endhasanyrole
        {{-- @hasanyrole('Super Admin|Admin|Production User')
    <li class="nav-item"> <a class="nav-link" href="{{ route('finishedgoods.index') }}">Finished
            Goods</a></li>
    @endhasanyrole
    @hasanyrole('Super Admin|Admin|Production Admin')
    <li class="nav-item"> <a class="nav-link" href="{{ route('finished_goods_approval.index') }}">Finished
            Goods Inspect</a></li>
    @endhasanyrole --}}
        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('overshortanddamage.index') }}">Over
                        Short And Damage Details Creation</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('disposal.index') }}">Disposal</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('miscreceived.index') }}">Miscellaneous
                        Received </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('miscissued.index') }}">Miscellaneous
                        Issued </a></li> --}}
        </ul>
        </div>
        </li>
    @endhasanyrole
    {{-- Planning / Layout Design --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-plan" aria-expanded="false"
                aria-controls="ui-plan">
                <span class="menu-title">Planning / Layout Design</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-plan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('warehouseareadesign.index') }}">Warehouse
                            Area Design</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('storagearea.index') }}">Storage
                            Area</a></li>
                </ul>
            </div>
        </li>
    @endhasanyrole
    {{-- Safety Criteria --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-safe" aria-expanded="false"
                aria-controls="ui-safe">
                <span class="menu-title">Safety Criteria </span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-safe">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('warehousesafety.index') }}">Warehouse
                            Safety</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('manandequipmentsafety.index') }}">Man
                            And Equipment Safety</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('equipmentmaintenance.index') }}">Equipment
                            Maintenance</a></li>
                </ul>
            </div>
        </li>
    @endhasanyrole
    {{-- ------ REPORTS---REPORTS----REPORTS-----REPORTS- --}}

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-report" aria-expanded="false"
            aria-controls="ui-report">
            <span class="menu-title">--------------Reports-------------</span>
        </a>
    </li>


    {{-- Sales and Marketing Reports --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-salesandmarketing" aria-expanded="false"
                aria-controls="ui-report-salesandmarketing">
                <span class="menu-title">Sales and Marketing</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-salesandmarketing">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Cash - Sales Report<br>
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('rawmaterialsserialcodeassigning.index') }}">Credit - Sales Report <br>
                        </a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Date-wise
                            Cash <br>and Credit Sales Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Weekly Sales Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('finishedgoodsserialcodeassigning.index') }}">Monthly Sales Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Annual
                            Sales Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Sales
                            Staff wise<br> Sales Status
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endhasanyrole

    {{-- Customer Relationship Managemenet Repots --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-customerRelationship" aria-expanded="false"
                aria-controls="ui-report-customerRelationship">
                <span class="menu-title">Customer Relationship <br> Management</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-customerRelationship">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Customer Relationship And <br>
                            Schedule</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('rawmaterialsserialcodeassigning.index') }}">Customer Relationship <br>
                            Assigning</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Customer
                            Relationship
                            Production </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Customer Relationship
                            Serial <br> Code Assigning</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('finishedgoodsserialcodeassigning.index') }}">Customer Relationship
                            <br>Code
                            Assigning </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Customer
                            Relationship</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Customer
                            Relationship
                            Creation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Customer
                            Relationship</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Customer
                            Relationship
                            Cost</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Customer
                            Relationship
                            Machanism <br>Production And Time <br>Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Customer
                            Relationship
                            Time Management</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Customer Relationship <br>By
                            Product</a>
                    </li>
                </ul>
            </div>
        </li>
    @endhasanyrole

    {{-- Supplier Relationship Managemenet Reports --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-supplierRelationship" aria-expanded="false"
                aria-controls="ui-report-supplierRelationship">
                <span class="menu-title">Supplier Relationship <br> Management</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-supplierRelationship">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Supplier Relationship And <br>
                            Schedule</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('rawmaterialsserialcodeassigning.index') }}">Supplier Relationship <br>
                            Assigning</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Supplier
                            Relationship
                            Production </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Supplier Relationship
                            Serial <br> Code Assigning</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('finishedgoodsserialcodeassigning.index') }}">Supplier Relationship
                            <br>Code
                            Assigning </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Supplier
                            Relationship</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Supplier
                            Relationship
                            Creation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Supplier
                            Relationship</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Supplier
                            Relationship
                            Cost</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Supplier
                            Relationship
                            Machanism <br>Production And Time <br>Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Supplier
                            Relationship
                            Time Management</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Supplier Relationship <br>By
                            Product</a>
                    </li>
                </ul>
            </div>
        </li>
    @endhasanyrole
    {{-- Demand Forecasting Reports --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-demandForeCasting" aria-expanded="false"
                aria-controls="ui-report-demandForeCasting">
                <span class="menu-title">Demand Forecasting <br> Reports</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-demandForeCasting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Demand Forecast Number<br>wise
                            Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('rawmaterialsserialcodeassigning.index') }}">Date-wise Demand
                            <br>Forecasted Report
                        </a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semiproduction.index') }}">Department-wise
                            Demand<br>Forecasted Stock
                            Items
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Demand Forecasted <br>
                            Stock Items Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('finishedgoodsserialcodeassigning.index') }}">Date wise Demand Forecasted
                            <br> Stock Items Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Demand
                            Forecasted<br> Stock Items Status</a></li>

                    <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Stock Items wise
                            <br>Demand Forecasted Report</a></li>

                </ul>
            </div>
        </li>
    @endhasanyrole
    {{-- Production Planning and Scheduling Reports --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-prodPlaning" aria-expanded="false"
                aria-controls="ui-report-prodPlaning">
                <span class="menu-title">Production Planning <br>and Scheduling </span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-prodPlaning">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Production Planning Schedule<br>
                            Number wise Report </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('rawmaterialsserialcodeassigning.index') }}">Job Order-wise <br>Production
                            Report
                        </a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Job
                            Order-wise <br>Batch Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Batch
                            Number-wise<br>Finished Goods Status
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('finishedgoodsserialcodeassigning.index') }}">Daily Finished<br>Goods
                            Status
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Date-wise
                            Finished <br>Goods Report </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Monthly
                            Finished<br> Goods Status
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Annual
                            Finished<br> Goods Status</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Daily
                            Production Report Cost</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Weekly
                            Production Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Monhly
                            Production Report
                        </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Annual Finished <br>Goods
                            Status</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Finished Goods<br> Dispatched
                            Status</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Stock Conversion Report </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Weekly Semi-Finished<br> Goods
                            Status </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Monthly Semi-Finished<br> Goods
                            Status </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Annual Semi-Finished<br> Goods
                            Status </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('operationmechanismbyproduct.index') }}">Daily Wastage Report </a>
                    </li>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Weekley
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Monthly
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Raw
                Materials Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Semi-Raw
                Materials Report</a>
        </li>
        </ul>
        </div>
        </li>
    @endhasanyrole

    {{-- Inventory Control Reports --}}
    @hasanyrole('Super Admin|Admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-invntoryControl" aria-expanded="false"
                aria-controls="ui-report-invntoryControl">
                <span class="menu-title">Inventory Control </span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-report-invntoryControl">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mrsreports.index') }}"> Material Return
                            Reports </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('BalanceOrder.index') }}"> Balancce Order
                            Reports </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('StockLoctionChange.index') }}"> Stock
                            Location Change Reports </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> Stock Items Catalogue </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> Stock Items Catalogue </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}"> Stock Items Status </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}"> Stock Items-wise <br>On Hand
                            Balance </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('stockreports.index') }}"> Stock
                            Items-wise<br>Transaction
                            History </a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('CurrentOnHandBalance.index') }}"> Current
                                Stock Balance Report
                                 </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}"> Stock Items Catalogue </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}"> Stock Items Catalogue </a></li>

                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('productionplanningandschedule.index') }}">Goods Received<br> Note Status </a>
                    </li> </a>
        </li>
        <li class="nav-item"> <a class="nav-link"
                href="{{ route('rawmaterialsserialcodeassigning.index') }}">Location-wise<br> Goods Received Note
            </a></li>
        {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a></li> --}}
        <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Supplier-wise Goods
                <br>Received Report
            </a></li>
        <li class="nav-item"> <a class="nav-link"
                href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Batch Number-wise<br>Finished Goods
                Status
            </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('finishedgoodsserialcodeassigning.index') }}">Daily
                Finished<br>Goods Status
            </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Date-wise Finished
                <br>Goods Report </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Monthly Finished<br>
                Goods Status
            </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Annual Finished<br> Goods
                Status</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Daily Production Report
                Cost</a></li>
        <li class="nav-item"> <a class="nav-link"
                href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Weekly Production Report
            </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Monhly Production
                Report
            </a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Stock
                Items-wise <br> Finished Goods Status</a>
        </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
                Finished <br>Goods Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Daily
                Finished <br>Goods Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Weekly
                Finished <br>Goods Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Monthly
                Finished <br>Goods Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
                Finished <br>Goods Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Finished
                Goods<br> Dispatched Status</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Stock
                Conversion Report </a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Daily
                Semi-Finished<br> Goods Status </a>
        </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Weekly
                Semi-Finished<br> Goods Status </a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Monthly
                Semi-Finished<br> Goods Status </a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
                Semi-Finished<br> Goods Status </a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Daily Wastage
                Report </a>
        </li>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Weekley
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Monthly
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
                Wastage Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Raw Materials
                Report</a>
        </li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Semi-Raw
                Materials Report</a>
        </li>
        </ul>
        </div>
        </li>
    @endhasanyrole
    {{-- Warehouse Management System Reports --}}
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-report-warehouseManagenemt" aria-expanded="false"
            aria-controls="ui-report-warehouseManagenemt">
            <span class="menu-title">Warehouse Management <br>System </span>
            {{-- <i class="menu-arrow"></i> --}}
            <i class="mdi mdi-contacts menu-icon"></i>
        </a>
        <div class="collapse" id="ui-report-warehouseManagenemt">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('productionplanningandschedule.index') }}">Production Planning Schedule<br>
                        Number wise Report </a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('rawmaterialsserialcodeassigning.index') }}">Job Order-wise <br>Production
                        Report
                    </a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('rawmaterialissueforproduction.index') }}">Raw Material Issue For Production</a>
    </li> --}}
                <li class="nav-item"> <a class="nav-link" href="{{ route('semiproduction.index') }}">Warehouse-wise
                        <br>Stock Items Received Status
                    </a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('semifinishedgoodsserialcodeassigning.index') }}">Batch
                        Number-wise<br>Finished Goods Status
                    </a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('finishedgoodsserialcodeassigning.index') }}">Daily Finished<br>Goods Status
                    </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('productionwastage.index') }}">Date-wise
                        Finished <br>Goods Report </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('jobordercreation.index') }}">Monthly
                        Finished<br> Goods Status
                    </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.index') }}">Annual Finished<br>
                        Goods Status</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('productioncost.index') }}">Daily
                        Production Report Cost</a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmachanismproductionandtimemanagement.index') }}">Weekly Production
                        Report
                    </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('planttimemanagement.index') }}">Monhly
                        Production Report
                    </a></li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Annual Finished <br>Goods Status</a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Finished Goods<br> Dispatched
                        Status</a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Stock Conversion Report </a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Weekly Semi-Finished<br> Goods Status
                    </a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Monthly Semi-Finished<br> Goods
                        Status </a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Annual Semi-Finished<br> Goods Status
                    </a>
                </li>
                <li class="nav-item"> <a class="nav-link"
                        href="{{ route('operationmechanismbyproduct.index') }}">Daily Wastage Report </a>
                </li>
    </li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Weekley
            Wastage Report</a>
    </li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Monthly
            Wastage Report</a>
    </li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Annual
            Wastage Report</a>
    </li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Raw Materials
            Report</a>
    </li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('operationmechanismbyproduct.index') }}">Semi-Raw
            Materials Report</a>
    </li>

    </ul>
    </div>
    </li>
    </ul>
</nav>
