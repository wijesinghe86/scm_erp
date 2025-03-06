<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DfController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SfgrnController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MrfPrfController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\BillTypeController;
use App\Http\Controllers\CustomerController;
//use App\Http\Controllers\DisposalController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MrequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MrApproveController;
use App\Http\Controllers\MrsReportController;
use App\Http\Controllers\PrApproveController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CreditNoteController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DfApprovalController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\StorageAreaController;
use App\Http\Controllers\TaxCreationController;
use App\Http\Controllers\CreditLimitLogContrller;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\FinishedGoodsController;
use App\Http\Controllers\GoodsReceivedController;
use App\Http\Controllers\InternalIssueController;
use App\Http\Controllers\InvoiceCancelController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UrgentInvoiceController;
use App\Http\Controllers\GoodsIssueNoteController;
use App\Http\Controllers\ProductionCostController;
use App\Http\Controllers\SemiProductionController;
use App\Http\Controllers\CreditNotePrintController;
use App\Http\Controllers\InvoiceSettingsController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\OpenningBalanceController;
use App\Http\Controllers\PurchaseOrderMrController;
use App\Http\Controllers\RawMaterialCodeController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\WarehouseSafetyController;
use App\Http\Controllers\DispatchApprovalController;
use App\Http\Controllers\JobOrderApprovalController;
use App\Http\Controllers\JobOrderCreationController;
use App\Http\Controllers\FleetRegistrationController;
use App\Http\Controllers\LocationBayDesigncontroller;
use App\Http\Controllers\LocationRowDesignController;
use App\Http\Controllers\PlantRegistrationController;
use App\Http\Controllers\ProductionWastageController;
use App\Http\Controllers\BalanceOrderReportController;
use App\Http\Controllers\CreditNoteApprovalController;
use App\Http\Controllers\LocationRackDesignController;
use App\Http\Controllers\RawMaterialRequestController;
use App\Http\Controllers\LocationShelfDesignController;
use App\Http\Controllers\MiscellaneousIssuedController;
use App\Http\Controllers\PlantTimeManagementController;
use App\Http\Controllers\RawMaterialReceivedController;
use App\Http\Controllers\StockLocationChangeController;
use App\Http\Controllers\WarehouseAreaDesignController;
use App\Http\Controllers\ReverseDeliveryOrderController;
use App\Http\Controllers\CustomerPaymentUpdateController;
use App\Http\Controllers\EquipmentRegistrationController;
use App\Http\Controllers\FinishedGoodsApprovalController;
use App\Http\Controllers\ManAndEquipmentSafetyController;
use App\Http\Controllers\MiscellaneousReceivedController;
use App\Http\Controllers\OverShortageAndDamageController;
use App\Http\Controllers\PurchaseOrderMrApproveController;
use App\Http\Controllers\MaterialsReturnByCustomerController;
use App\Http\Controllers\RawMaterialRequestApproveController;
use App\Http\Controllers\StockLocationChangeReportController;
use App\Http\Controllers\ProductionPlanningApprovalController;
use App\Http\Controllers\OperationMechanismByProductController;
use App\Http\Controllers\ProductionPlanningAndScheduleController;
use App\Http\Controllers\RawMaterialIssueForProductionController;
use App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController;
use App\Http\Controllers\OperationMachanismProductionAndTimeManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::middleware(['auth', 'custom.auth'])->group(function () {


    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');


    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('cart/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

    // Master Files-------
    /* .....CREATING ROUTE FOR Customer Creation ....... */
    Route::prefix('customer')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Sales User|Sales Admin|Executive User'])->get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Sales Admin'])->get('/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Sales Admin'])->post('/create', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor|Executive User'])->get('/{customer_id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor|Executive User'])->post('/{customer_id}/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{customer_id}/delete', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customer.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\CustomerController::class, 'deleted'])->name('customer.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{customer_id}/restore', [App\Http\Controllers\CustomerController::class, 'restore'])->name('customer.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{customer_id}/delete/force', [App\Http\Controllers\CustomerController::class, 'deleteForce'])->name('customer.forcedelete');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Sales Admin'])->get('/{customer_id}', [App\Http\Controllers\CustomerController::class, 'view'])->name('customer.view');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{customer_id}/active', [App\Http\Controllers\CustomerController::class, 'active'])->name('customer.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{customer_id}/deactive', [App\Http\Controllers\CustomerController::class, 'deactive'])->name('customer.deactive');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/print', [App\Http\Controllers\CustomerController::class, 'print'])->name('customer.print');
        Route::middleware(['role:Super Admin|Admin|Sales User|Warehouse User|Executive User'])->get('/get/data', [CustomerController::class, 'getData'])->name('customer.get.data');
    });

    /* .....CREATING ROUTE FOR Supplier Registration ....... */
    Route::prefix('supplier')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Procurement User'])->get('supplier', [SupplierController::class, 'all'])->name('supplier.all');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Procurement User'])->get('/new', [SupplierController::class, 'new'])->name('supplier.new');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Procurement User'])->post('/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{supplier_id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{supplier_id}/update', [SupplierController::class, 'update'])->name('supplier.update');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{supplier_id}/delete', [SupplierController::class, 'delete'])->name('supplier.delete');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/deleted', [SupplierController::class, 'deleted'])->name('supplier.deleted');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{supplier_id}/restore', [SupplierController::class, 'restore'])->name('supplier.restore');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor|Master Data Editor'])->get('/{supplier_id}/delete/force', [SupplierController::class, 'deleteForce'])->name('supplier.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|procurement User'])->get('/{supplier_id}', [SupplierController::class, 'view'])->name('supplier.view');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{supplier_id}/active', [SupplierController::class, 'active'])->name('supplier.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{supplier_id}/deactive', [SupplierController::class, 'deactive'])->name('supplier.deactive');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/get/data', [SupplierController::class, 'getData'])->name('supplier.get.data');
    });

    /* .....CREATING ROUTE FOR Stock Item Creation ....... */
    Route::prefix('stockitem')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production Admin|Factory Warehouse User|Factory Admin'])->get('stockitem', [App\Http\Controllers\StockItemController::class, 'all'])->name('stockitem.all');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->get('/create', [App\Http\Controllers\StockItemController::class, 'create'])->name('stockitem.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->post('/create', [App\Http\Controllers\StockItemController::class, 'store'])->name('stockitem.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{stockitem_id}/edit', [App\Http\Controllers\StockItemController::class, 'edit'])->name('stockitem.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{stockitem_id}/update', [App\Http\Controllers\StockItemController::class, 'update'])->name('stockitem.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{stockitem_id}/delete', [App\Http\Controllers\StockItemController::class, 'delete'])->name('stockitem.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\StockItemController::class, 'deleted'])->name('stockitem.deleted');
        Route::middleware(['role:Super Admin|Admin'])->post('/{stockitem_id}/restore', [App\Http\Controllers\StockItemController::class, 'restore'])->name('stockitem.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{stockitem_id}/delete/force', [App\Http\Controllers\StockItemController::class, 'deleteforce'])->name('stockitem.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{stockitem_id}', [App\Http\Controllers\StockItemController::class, 'view'])->name('stockitem.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Warehouse User'])->get('/get/data', [App\Http\Controllers\StockItemController::class, 'getData'])->name('stockitem.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{stockitem_id}/active', [App\Http\Controllers\StockItemController::class, 'active'])->name('stockitem.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{stockitem_id}/deactive', [App\Http\Controllers\StockItemController::class, 'deactive'])->name('stockitem.deactive');
    });

    /* .....CREATING ROUTE FOR Warehouse Creation ....... */
    Route::prefix('warehouse')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production Admin|Factory Warehouse User|Factory Admin'])->get('warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->get('/create', [App\Http\Controllers\WarehouseController::class, 'create'])->name('warehouse.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->post('/create', [App\Http\Controllers\WarehouseController::class, 'store'])->name('warehouse.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{warehouse_id}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{warehouse_id}/update', [WarehouseController::class, 'update'])->name('warehouse.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{warehouse_id}/delete', [WarehouseController::class, 'delete'])->name('warehouse.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [WarehouseController::class, 'deleted'])->name('warehouse.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{warehouse_id}/restore', [WarehouseController::class, 'restore'])->name('warehouse.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{warehouse_id}/delete/force', [WarehouseController::class, 'deleteforce'])->name('warehouse.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{warehouse_id}/view', [WarehouseController::class, 'view'])->name('warehouse.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Warehouse User'])->get('/get/data', [WarehouseController::class, 'getData'])->name('warehouse.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{warehouse_id}/active', [WarehouseController::class, 'active'])->name('warehouse.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{warehouse_id}/deactive', [WarehouseController::class, 'deactive'])->name('warehouse.deactive');
    });
    /* .....CREATING ROUTE FOR Stock Adjustment ....... */
    Route::prefix('StockAdjustment')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin'])->get('/', [StockAdjustmentController::class, 'index'])->name('stockadjustment.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->get('/create', [StockAdjustmentController::class, 'create'])->name('stockadjustment.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/create', [StockAdjustmentController::class, 'store'])->name('stockadjustment.store');

        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/add-to-table', [StockAdjustmentController::class, 'addToTable'])->name('stockadjustment.addToTable');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/remove-from-table', [StockAdjustmentController::class, 'removeFromTable'])->name('stockadjustment.removeFromTable');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->get('/view-table', [StockAdjustmentController::class, 'viewTable'])->name('stockadjustment.viewTable');

        Route::middleware(['role:Super Admin|Admin|Warehouse Admin|Factory Admin'])->get('/approval/{stock_adjustment}', [StockAdjustmentController::class, 'approvalIndex'])->name('stockadjustment.approvalIndex');
        Route::middleware(['role:Super Admin|Admin|Warehouse Admin|Factory Admin'])->post('/approval/{stock_adjustment}', [StockAdjustmentController::class, 'approval'])->name('stockadjustment.approval');
    });

    /* .....CREATING ROUTE FOR Location Bay Design ....... */
    Route::prefix('locationbaydesign')->group(function () {
        Route::middleware(['role:Super Admin|Admin'])->get('locationbaydesign', [App\Http\Controllers\LocationBayDesignController::class, 'index'])->name('locationbaydesign.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [App\Http\Controllers\LocationBayDesignController::class, 'create'])->name('locationbaydesign.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [App\Http\Controllers\LocationBayDesignController::class, 'store'])->name('locationbaydesign.store');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/edit', [App\Http\Controllers\LocationBayDesignController::class, 'edit'])->name('locationbaydesign.edit');
        Route::middleware(['role:Super Admin|Admin'])->post('/{locationbaydesign_id}/update', [App\Http\Controllers\LocationBayDesignController::class, 'update'])->name('locationbaydesign.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/delete', [App\Http\Controllers\LocationBayDesignController::class, 'delete'])->name('locationbaydesign.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\LocationBayDesignController::class, 'deleted'])->name('locationbaydesign.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/restore', [App\Http\Controllers\LocationBayDesignController::class, 'restore'])->name('locationbaydesign.restore');
        Route::middleware(['role:Super Admin|Admin'])->post('/{locationbaydesign_id}/delete/force', [App\Http\Controllers\LocationBayDesignController::class, 'deleteforce'])->name('locationbaydesign.delete.force');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/view', [App\Http\Controllers\LocationBayDesignController::class, 'view'])->name('locationbaydesign.view');
        Route::middleware(['role:Super Admin|Admin'])->get('/get/data', [App\Http\Controllers\LocationBayDesignController::class, 'getData'])->name('locationbaydesign.get.data');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/active', [App\Http\Controllers\LocationBayDesignController::class, 'active'])->name('locationbaydesign.active');
        Route::middleware(['role:Super Admin|Admin'])->get('/{locationbaydesign_id}/deactive', [App\Http\Controllers\LocationBayDesignController::class, 'deactive'])->name('locationbaydesign.deactive');
    });

    /* .....CREATING ROUTE FOR plant Registration ....... */
    Route::prefix('PlantRegistration')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production Admin|Factory Warehouse User|Factory Admin'])->get('PlantRegistration', [App\Http\Controllers\PlantRegistrationController::class, 'index'])->name('PlantRegistration.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production User|Production Admin'])->get('/create', [App\Http\Controllers\PlantRegistrationController::class, 'create'])->name('PlantRegistration.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production User|Production Admin'])->post('/create', [App\Http\Controllers\PlantRegistrationController::class, 'store'])->name('PlantRegistration.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{plantregistration_id}/edit', [App\Http\Controllers\PlantRegistrationController::class, 'edit'])->name('plantregistration.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{plantregistration_id}/update', [App\Http\Controllers\PlantRegistrationController::class, 'update'])->name('plantregistration.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{plantregistration_id}/delete', [App\Http\Controllers\PlantRegistrationController::class, 'delete'])->name('plantregistration.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\PlantRegistrationController::class, 'deleted'])->name('plantregistration.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{plantregistration_id}/restore', [App\Http\Controllers\PlantRegistrationController::class, 'restore'])->name('plantregistration.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{plantregistration_id}/delete/force', [App\Http\Controllers\PlantRegistrationController::class, 'deleteforce'])->name('plantregistration.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{plantregistration_id}/view', [App\Http\Controllers\PlantRegistrationController::class, 'view'])->name('plantregistration.view');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/get/data', [App\Http\Controllers\PlantRegistrationController::class, 'getData'])->name('plantregistration.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{plantregistration_id}/active', [App\Http\Controllers\PlantRegistrationController::class, 'active'])->name('plantregistration.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{plantregistration_id}/deactive', [App\Http\Controllers\PlantRegistrationController::class, 'deactive'])->name('plantregistration.deactive');
    });

    /* .....CREATING ROUTE FOR Employee Registration ....... */
    Route::prefix('Employee')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/', [App\Http\Controllers\EmployeeController::class, 'all'])->name('employee.all');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->get('/new', [EmployeeController::class, 'new'])->name('employee.new');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->post('/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{employee_id}/update', [EmployeeController::class, 'update'])->name('employee.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{employee_id}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [EmployeeController::class, 'deleted'])->name('employee.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{employee_id}/restore', [EmployeeController::class, 'restore'])->name('employee.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{employee_id}/delete/force', [EmployeeController::class, 'deleteForce'])->name('employee.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{employee_id}', [EmployeeController::class, 'view'])->name('employee.view');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{employee_id}/active', [EmployeeController::class, 'active'])->name('employee.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{employee_id}/deactive', [EmployeeController::class, 'deactive'])->name('employee.deactive');
        /*........Create this route to get department and section from Employee to the MR request....*/
        Route::middleware(['role:Super Admin|Admin|Sales User|Warehouse User'])->get('/get/data', [EmployeeController::class, 'getData'])->name('employee.get.data');
    });

    /* .....CREATING ROUTE FOR Department Registration ....... */
    Route::prefix('Department')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('Department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->get('/create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->post('/create', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{department_id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{department_id}/update', [DepartmentController::class, 'update'])->name('department.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{department_id}/delete', [DepartmentController::class, 'delete'])->name('department.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\DepartmentController::class, 'deleted'])->name('department.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{department_id}/restore', [App\Http\Controllers\DepartmentController::class, 'restore'])->name('department.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{department_id}/delete/force', [App\Http\Controllers\DepartmentController::class, 'deleteforce'])->name('department.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{department_id}/view', [App\Http\Controllers\DepartmentController::class, 'view'])->name('department.view');
        Route::middleware(['role:Super Admin|Admin'])->get('/get/data', [App\Http\Controllers\DepartmentController::class, 'getData'])->name('department.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{department_id}/active', [App\Http\Controllers\DepartmentController::class, 'active'])->name('department.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{department_id}/deactive', [App\Http\Controllers\DepartmentController::class, 'deactive'])->name('department.deactive');
    });

    /* .....CREATING ROUTE FOR Tax Creation ....... */
    Route::prefix('TaxCreation')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('TaxCreation', [App\Http\Controllers\TaxCreationController::class, 'index'])->name('taxcreation.index');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/create', [App\Http\Controllers\TaxCreationController::class, 'create'])->name('taxcreation.create');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('/create', [App\Http\Controllers\TaxCreationController::class, 'store'])->name('taxcreation.store');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->get('/{taxcreation_id}/edit', [TaxCreationController::class, 'edit'])->name('taxcreation.edit');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->post('/{taxcreation_id}/update', [TaxCreationController::class, 'update'])->name('taxcreation.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{taxcreation_id}/delete', [TaxCreationController::class, 'delete'])->name('taxcreation.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [TaxCreationController::class, 'deleted'])->name('taxcreation.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{taxcreation_id}/restore', [TaxCreationController::class, 'restore'])->name('taxcreation.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{taxcreation_id}/delete/force', [TaxCreationController::class, 'deleteforce'])->name('taxcreation.delete.force');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/{taxcreation_id}/view', [TaxCreationController::class, 'view'])->name('taxcreation.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/get/data', [App\Http\Controllers\TaxCreationController::class, 'getData'])->name('taxcreation.get.data');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->get('/{taxcreation_id}/active', [App\Http\Controllers\TaxCreationController::class, 'active'])->name('taxcreation.active');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->get('/{taxcreation_id}/deactive', [App\Http\Controllers\TaxCreationController::class, 'deactive'])->name('taxcreation.deactive');
    });

    /* .....CREATING ROUTE FOR Fleet Registration ....... */
    Route::prefix('FleetRegistration')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production Admin|Factory Warehouse User|Factory Admin'])->get('FleetRegistration', [App\Http\Controllers\FleetRegistrationController::class, 'index'])->name('fleetregistration.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->get('/create', [App\Http\Controllers\FleetRegistrationController::class, 'create'])->name('fleetregistration.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->post('/create', [App\Http\Controllers\FleetRegistrationController::class, 'store'])->name('fleetregistration.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{fleetregistration_id}/edit', [App\Http\Controllers\FleetRegistrationController::class, 'edit'])->name('fleetregistration.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{fleetregistration_id}/update', [App\Http\Controllers\FleetRegistrationController::class, 'update'])->name('fleetregistration.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{fleetregistration_id}/delete', [App\Http\Controllers\FleetRegistrationController::class, 'delete'])->name('fleetregistration.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\FleetRegistrationController::class, 'deleted'])->name('fleetregistration.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{fleetregistration_id}/restore', [App\Http\Controllers\FleetRegistrationController::class, 'restore'])->name('fleetregistration.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{fleetregistration_id}/delete/force', [App\Http\Controllers\FleetRegistrationController::class, 'deleteforce'])->name('fleetregistration.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{fleetregistration_id}/view', [App\Http\Controllers\FleetRegistrationController::class, 'view'])->name('fleetregistration.view');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/get/data', [App\Http\Controllers\FleetRegistrationController::class, 'getData'])->name('fleetregistration.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{fleetregistration_id}/active', [App\Http\Controllers\FleetRegistrationController::class, 'active'])->name('fleetregistration.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{fleetregistration_id}/deactive', [App\Http\Controllers\FleetRegistrationController::class, 'deactive'])->name('fleetregistration.deactive');
    });

    /* .....CREATING ROUTE FOR Equipment Registration ....... */
    Route::prefix('EquipmentRegistration')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor|Production User|Production Admin|Factory Warehouse User|Factory Admin'])->get('EquipmentRegistration', [App\Http\Controllers\EquipmentRegistrationController::class, 'index'])->name('equipmentregistration.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->get('/create', [App\Http\Controllers\EquipmentRegistrationController::class, 'create'])->name('equipmentregistration.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Production Admin'])->post('/create', [App\Http\Controllers\EquipmentRegistrationController::class, 'store'])->name('equipmentregistration.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{equipmentregistration_id}/edit', [App\Http\Controllers\EquipmentRegistrationController::class, 'edit'])->name('equipmentregistration.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{equipmentregistration_id}/update', [App\Http\Controllers\EquipmentRegistrationController::class, 'update'])->name('equipmentregistration.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{equipmentregistration_id}/delete', [App\Http\Controllers\EquipmentRegistrationController::class, 'delete'])->name('equipmentregistration.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\EquipmentRegistrationController::class, 'deleted'])->name('equipmentregistration.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{equipmentregistration_id}/restore', [App\Http\Controllers\EquipmentRegistrationController::class, 'restore'])->name('equipmentregistration.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{equipmentregistration_id}/delete/force', [App\Http\Controllers\EquipmentRegistrationController::class, 'deleteforce'])->name('equipmentregistration.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{equipmentregistration_id}/view', [App\Http\Controllers\EquipmentRegistrationController::class, 'view'])->name('equipmentregistration.view');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/get/data', [App\Http\Controllers\EquipmentRegistrationController::class, 'getData'])->name('equipmentregistration.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{equipmentregistration_id}/active', [App\Http\Controllers\EquipmentRegistrationController::class, 'active'])->name('equipmentregistration.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{equipmentregistration_id}/deactive', [App\Http\Controllers\EquipmentRegistrationController::class, 'deactive'])->name('equipmentregistration.deactive');
    });

    /* .....CREATING ROUTE FOR Section Creation ....... */
    Route::prefix('Section')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('Section', [App\Http\Controllers\SectionController::class, 'index'])->name('section.index');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->get('/create', [App\Http\Controllers\SectionController::class, 'create'])->name('section.create');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry'])->post('/create', [App\Http\Controllers\SectionController::class, 'store'])->name('section.store');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{section_id}/edit', [App\Http\Controllers\SectionController::class, 'edit'])->name('section.edit');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->post('/{section_id}/update', [App\Http\Controllers\SectionController::class, 'update'])->name('section.update');
        Route::middleware(['role:Super Admin|Admin'])->get('/{section_id}/delete', [App\Http\Controllers\SectionController::class, 'delete'])->name('section.delete');
        Route::middleware(['role:Super Admin|Admin'])->get('/deleted', [App\Http\Controllers\SectionController::class, 'deleted'])->name('section.deleted');
        Route::middleware(['role:Super Admin|Admin'])->get('/{section_id}/restore', [App\Http\Controllers\SectionController::class, 'restore'])->name('section.restore');
        Route::middleware(['role:Super Admin|Admin'])->get('/{section_id}/delete/force', [App\Http\Controllers\SectionController::class, 'deleteforce'])->name('section.delete.force');
        Route::middleware(['role:Super Admin|Admin|Master Data Entry|Master Data Editor'])->get('/{section_id}/view', [App\Http\Controllers\SectionController::class, 'view'])->name('section.view');
        Route::middleware(['role:Super Admin|Admin'])->get('/get/data', [App\Http\Controllers\SectionController::class, 'getData'])->name('section.get.data');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{section_id}/active', [App\Http\Controllers\SectionController::class, 'active'])->name('section.active');
        Route::middleware(['role:Super Admin|Admin|Master Data Editor'])->get('/{section_id}/deactive', [App\Http\Controllers\SectionController::class, 'deactive'])->name('section.deactive');
    });

    /* .....CREATING ROUTE FOR BILL TYPES Creation ....... */
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->prefix('billtypes')->group(function () {
        Route::get('/', [BillTypeController::class, 'all'])->name('billtypes.all');
        Route::get('/new', [BillTypeController::class, 'new'])->name('billtypes.new');
        Route::get('/{billtype_Id}', [BillTypeController::class, 'get'])->name('billtypes.get');
        Route::post('/store', [BillTypeController::class, 'store'])->name('billtypes.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('Locationrowdesign')->group(function () {
        Route::get('Locationrowdesign', [App\Http\Controllers\LocationRowDesignController::class, 'index'])->name('locationrowdesign.index');
        Route::get('/create', [App\Http\Controllers\LocationRowDesignController::class, 'create'])->name('locationrowdesign.create');
        Route::post('/create', [App\Http\Controllers\LocationRowDesignController::class, 'store'])->name('locationrowdesign.store');
        Route::get('/{locationrowdesign_id}/edit', [App\Http\Controllers\LocationRowDesignController::class, 'edit'])->name('locationrowdesign.edit');
        Route::post('/{locationrowdesign_id}/update', [App\Http\Controllers\LocationRowDesignController::class, 'update'])->name('locationrowdesign.update');
        Route::get('/{locationrowdesign_id}/delete', [App\Http\Controllers\LocationRowDesignController::class, 'delete'])->name('locationrowdesign.delete');
        Route::get('/deleted', [App\Http\Controllers\LocationRowDesignController::class, 'deleted'])->name('locationrowdesign.deleted');
        Route::get('/{locationrowdesign_id}/restore', [App\Http\Controllers\LocationRowDesignController::class, 'restore'])->name('locationrowdesign.restore');
        Route::get('/{locationrowdesign_id}/delete/force', [App\Http\Controllers\LocationRowDesignController::class, 'deleteforce'])->name('locationrowdesign.delete.force');
        Route::get('/{locationrowdesign_id}/view', [App\Http\Controllers\LocationRowDesignController::class, 'view'])->name('locationrowdesign.view');
        Route::get('/get/data', [App\Http\Controllers\LocationRowDesignController::class, 'getData'])->name('locationrowdesign.get.data');
        Route::get('/{locationrowdesign_id}/active', [App\Http\Controllers\LocationRowDesignController::class, 'active'])->name('locationrowdesign.active');
        Route::get('/{locationrowdesign_id}/deactive', [App\Http\Controllers\LocationRowDesignController::class, 'deactive'])->name('locationrowdesign.deactive');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('LocationRackDesign')->group(function () {
        Route::get('LocationRackDesign', [App\Http\Controllers\LocationRackDesignController::class, 'index'])->name('locationrackdesign.index');
        Route::get('/create', [LocationRackDesignController::class, 'create'])->name('locationrackdesign.create');
        Route::post('/create', [App\Http\Controllers\LocationRackDesignController::class, 'store'])->name('locationrackdesign.store');
        Route::get('/{locationrackdesign_id}/edit', [App\Http\Controllers\LocationRackDesignController::class, 'edit'])->name('locationrackdesign.edit');
        Route::post('/{locationrackdesign_id}/update', [App\Http\Controllers\LocationRackDesignController::class, 'update'])->name('locationrackdesign.update');
        Route::get('/{locationrackdesign_id}/delete', [App\Http\Controllers\LocationRackDesignController::class, 'delete'])->name('locationrackdesign.delete');
        Route::get('/deleted', [App\Http\Controllers\LocationRackDesignController::class, 'deleted'])->name('locationrackdesign.deleted');
        Route::get('/{locationrackdesign_id}/restore', [App\Http\Controllers\LocationRackDesignController::class, 'restore'])->name('locationrackdesign.restore');
        Route::get('/{locationrackdesign_id}/delete/force', [App\Http\Controllers\LocationRackDesignController::class, 'deleteforce'])->name('locationrackdesign.delete.force');
        Route::get('/{locationrackdesign_id}/view', [App\Http\Controllers\LocationRackDesignController::class, 'view'])->name('locationrackdesign.view');
        Route::get('/get/data', [App\Http\Controllers\LocationRackDesignController::class, 'getData'])->name('locationrackdesign.get.data');
        Route::get('/{locationrackdesign_id}/active', [App\Http\Controllers\LocationRackDesignController::class, 'active'])->name('locationrackdesign.active');
        Route::get('/{locationrackdesign_id}/deactive', [App\Http\Controllers\LocationRackDesignController::class, 'deactive'])->name('locationrackdesign.deactive');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('LocationShelfDesign')->group(function () {
        Route::get('LocationShelfDesign', [LocationShelfDesignController::class, 'index'])->name('locationshelfdesign.index');
        Route::get('/create', [LocationShelfDesignController::class, 'create'])->name('locationshelfdesign.create');
        Route::post('/create', [App\Http\Controllers\LocationShelfDesignController::class, 'store'])->name('locationshelfdesign.store');
        Route::get('/{locationshelfdesign_id}/edit', [App\Http\Controllers\LocationShelfDesignController::class, 'edit'])->name('locationshelfdesign.edit');
        Route::post('/{locationshelfdesign_id}/update', [App\Http\Controllers\LocationShelfDesignController::class, 'update'])->name('locationshelfdesign.update');
        Route::get('/{locationshelfdesign_id}/delete', [App\Http\Controllers\LocationShelfDesignController::class, 'delete'])->name('locationshelfdesign.delete');
        Route::get('/deleted', [App\Http\Controllers\LocationShelfDesignController::class, 'deleted'])->name('locationshelfdesign.deleted');
        Route::get('/{locationshelfdesign_id}/restore', [App\Http\Controllers\LocationShelfDesignController::class, 'restore'])->name('locationshelfdesign.restore');
        Route::get('/{locationshelfdesign_id}/delete/force', [App\Http\Controllers\LocationShelfDesignController::class, 'deleteforce'])->name('locationshelfdesign.delete.force');
        Route::get('/{locationshelfdesign_id}/view', [App\Http\Controllers\LocationShelfDesignController::class, 'view'])->name('locationshelfdesign.view');
        Route::get('/get/data', [App\Http\Controllers\LocationShelfDesignController::class, 'getData'])->name('locationshelfdesign.get.data');
        Route::get('/{locationshelfdesign_id}/active', [App\Http\Controllers\LocationShelfDesignController::class, 'active'])->name('locationshelfdesign.active');
        Route::get('/{locationshelfdesign_id}/deactive', [App\Http\Controllers\LocationShelfDesignController::class, 'deactive'])->name('locationshelfdesign.deactive');
    });

    /* .....CREATING ROUTE FOR Purchase Request ....... */
    Route::middleware(['role:Super Admin|Admin'])->get('purchase-request', [App\Http\Controllers\PurchasingRequestController::class, 'index'])->name('purchase_request.index');
    Route::get('purchase-request/create', [App\Http\Controllers\PurchasingRequestController::class, 'create'])->name('purchase_request.create');
    Route::post('purchase-request/create', [App\Http\Controllers\PurchasingRequestController::class, 'store'])->name('purchase_request.store');
    Route::get('purchase-request/delete/{index}', [App\Http\Controllers\PurchasingRequestController::class, 'deleteSessionItem'])->name('purchase_request.delete_item');

    /* .....CREATING ROUTE FOR InvoiceSetting ....... */
    Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->prefix('invoicesettings')->group(function () {
        Route::get('/', [InvoiceSettingsController::class, 'all'])->name('invoicesettings.all');
        Route::post('/update', [InvoiceSettingsController::class, 'update'])->name('invoicesettings.update');
    });

    // Sales and Marketing
    /* .....CREATING ROUTE FOR Invoice ....... */
    Route::middleware(['role:Super Admin|Admin|Sales User'])->prefix('invoices')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/', [InvoiceController::class, 'all'])->name('invoices.all');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/new', [InvoiceController::class, 'new'])->name('invoices.new');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->post('/new', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->post('/item/store', [InvoiceController::class, 'storeItem'])->name('invoices.item.store');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->post('/item/delete', [InvoiceController::class, 'deleteItem'])->name('invoices.item.delete');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/get/items/table', [InvoiceController::class, 'itemsTable'])->name('invoices.item.table');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/{invoice_id}/preview', [InvoiceController::class, 'preview'])->name('invoices.preview');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/{invoice_id}/print', [InvoiceController::class, 'print'])->name('invoices.print');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->get('/{invoice_id}/cancel', [InvoiceController::class, 'cancel'])->name('invoices.cancel');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/get/data', [InvoiceController::class, 'getData'])->name('invoices.get.data');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/get/total', [InvoiceController::class, 'getInvoiceTotal'])->name('invoices.get.total');
        Route::middleware(['role:Super Admin|Admin|Sales User'])->get('/get/invoice_no', [InvoiceController::class, 'generateInvoiceNumber'])->name('invoices.get.number');
    });
    Route::middleware(['role:Super Admin|Admin|Sales User'])->prefix('invoices')->group(function () {
        Route::get('/create', [InvoiceCancelController::class, 'create'])->name('invoices_cancel.create');
        Route::get('/store', [InvoiceCancelController::class, 'store'])->name('invoices_cancel.store');
        Route::post('/getInvoiceDetails', [InvoiceCancelController::class, 'getInvDetails'])->name('invoices_cancel.getInvoiceDetails');
    });

    /* .....CREATING ROUTE FOR Delivery Order ....... */
    Route::middleware(['role:Super Admin|Admin|Warehouse User|Sales Admin'])->prefix('deliveryorders')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Sales Admin'])->get('/all', [DeliveryOrderController::class, 'all'])->name('deliveryorders.all');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/new', [DeliveryOrderController::class, 'new'])->name('deliveryorders.new');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->post('/new', [DeliveryOrderController::class, 'store'])->name('deliveryorders.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{delivery_order}/view', [DeliveryOrderController::class, 'view'])->name('deliveryorders.view');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/get-items', [DeliveryOrderController::class, 'getInvoiceItems'])->name('deliveryorders.getInvoiceItems');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{delivery_order}/issue_delivery_order', [DeliveryOrderController::class, 'issueIndex'])->name('deliveryorders.issueIndex');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->post('/{delivery_order}/issue_delivery_order', [DeliveryOrderController::class, 'issueStore'])->name('deliveryorders.issueStore');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{delivery_order}/get', [DeliveryOrderController::class, 'getById'])->name('deliveryorders.getById');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{delivery_order_id}/print', [DeliveryOrderController::class, 'print'])->name('deliveryorders.print');
        Route::middleware(['role:Super Admin|Admin|Sales Admin'])->get('/{delivery_order_id}/cancel', [DeliveryOrderController::class, 'cancel'])->name('deliveryorders.cancel');
    });

    Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin'])->prefix('returns')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin'])->get('/', [ReturnController::class, 'all'])->name('returns.all');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/new', [ReturnController::class, 'new'])->name('returns.new');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->post('/new', [ReturnController::class, 'store'])->name('returns.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{invoice_return}/view', [ReturnController::class, 'view'])->name('returns.view');

        Route::middleware(['role:Super Admin|Admin|Warehouse Admin'])->get('/approval', [ReturnController::class, 'approvalIndex'])->name('returns.approvalIndex');
        Route::middleware(['role:Super Admin|Admin|Warehouse Admin'])->post('{invoice_return}/approval', [ReturnController::class, 'approval'])->name('returns.approval');
    });

    // Inventory Control
    /* .....CREATING ROUTE FOR Openning Balance Entry ....... */
    Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Warehouse User|Warehouse Admin|Factory Admin'])->prefix('obentry')->group(function () {
        Route::get('/', [OpenningBalanceController::class, 'index'])->name('obentry.index');
        Route::get('/create', [OpenningBalanceController::class, 'create'])->name('obentry.create');
        Route::post('/create', [OpenningBalanceController::class, 'store'])->name('obentry.store');
        Route::post('/get-stock', [OpenningBalanceController::class, 'getStock'])->name('obentry.stock');
    });
    /* .....CREATING ROUTE FOR On Hand Balance Report ....... */
    Route::middleware(['role:Super Admin|Admin|Production Admin'])->prefix('stock')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stock.index1');
        Route::get('/', [StockController::class, 'index2'])->name('stock.index2');
    });
    /* .....CREATING ROUTE FOR Miscellaneous Received ....... */
    Route::middleware(['role:Super Admin|Admin|'])->prefix('miscreceived')->group(function () {
        Route::get('/', [MiscellaneousReceivedController::class, 'index'])->name('miscreceived.index');
        Route::get('/create', [MiscellaneousReceivedController::class, 'create'])->name('miscreceived.create');
        Route::post('/create', [MiscellaneousReceivedController::class, 'store'])->name('miscreceived.store');
        Route::post('/item/store', [MiscellaneousReceivedController::class, 'storeItem'])->name('miscreceived.item.store');
        Route::get('/get/items/table', [MiscellaneousReceivedController::class, 'itemsTable'])->name('miscreceived.item.table');
    });

    /* .....CREATING ROUTE FOR Miscellaneous Issued ....... */
    Route::middleware(['role:Super Admin|Admin'])->prefix('miscissued')->group(function () {
        Route::get('/', [MiscellaneousIssuedController::class, 'index'])->name('miscissued.index');
        Route::get('/create', [MiscellaneousIssuedController::class, 'create'])->name('miscissued.create');
        Route::post('/create', [MiscellaneousIssuedController::class, 'store'])->name('miscissued.store');
        Route::post('/item/store', [MiscellaneousIssuedController::class, 'storeItem'])->name('miscissued.item.store');
        Route::get('/get/items/table', [MiscellaneousIssuedController::class, 'itemsTable'])->name('miscissued.item.table');
    });


    /* .....CREATING ROUTE FOR Stock Location Change ....... */
    Route::prefix('StockLocationChange')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin'])->get('/', [StockLocationChangeController::class, 'index'])->name('stocklocationchange.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->get('/create', [StockLocationChangeController::class, 'create'])->name('stocklocationchange.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/create', [StockLocationChangeController::class, 'store'])->name('stocklocationchange.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/add-to-table', [StockLocationChangeController::class, 'addItemToTable'])->name('stocklocationchange.addItemToTable');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/remove-from-table', [StockLocationChangeController::class, 'removeItemFromTable'])->name('stocklocationchange.removeItemFromTable');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->get('/view-table', [StockLocationChangeController::class, 'getItemTable'])->name('stocklocationchange.getItemTable');


        Route::middleware(['role:Super Admin|Admin|Warehouse Admin|Factory Admin'])->get('/approvals', [StockLocationChangeController::class, 'approvalIndex'])->name('stocklocationchange_approvals.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse Admin|Factory Admin'])->get('/approvals/{slc}/create', [StockLocationChangeController::class, 'approvalCreateIndex'])->name('stocklocationchange_approvals.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse Admin|Factory Admin'])->post('/approvals/{slc}/create', [StockLocationChangeController::class, 'approvalStore'])->name('stocklocationchange_approvals.store');

        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User|Factory Admin'])->get('/received', [StockLocationChangeController::class, 'receivedIndex'])->name('stocklocationchange_received.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->get('/received/{slc}/create', [StockLocationChangeController::class, 'receivedCreateIndex'])->name('stocklocationchange_received.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Factory Warehouse User'])->post('/received/{slc}/create', [StockLocationChangeController::class, 'receivedStore'])->name('stocklocationchange_received.store');
    });

    Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Production User|Production Admin'])->prefix('material_request')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Production User|Production Admin'])->get('/', [App\Http\Controllers\MaterialRequestController::class, 'index'])->name('material_request.index');
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Production User|Production Admin'])->get('/create', [App\Http\Controllers\MaterialRequestController::class, 'create'])->name('material_request.create');
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Production User|Production Admin'])->post('/create', [App\Http\Controllers\MaterialRequestController::class, 'store'])->name('material_request.store');
        Route::middleware(['role:Super Admin|Admin|Factory Admin|Factory Warehouse User|Production Admin'])->get('material_request/delete/{index}', [MaterialRequestController::class, 'deleteSessionItem'])->name('material_request.delete_item');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('raw_material_request')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/', [App\Http\Controllers\RawMaterialRequestController::class, 'index'])->name('raw_material_request.index');
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/create', [App\Http\Controllers\RawMaterialRequestController::class, 'create'])->name('raw_material_request.create');
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->post('/create', [App\Http\Controllers\RawMaterialRequestController::class, 'store'])->name('raw_material_request.store');
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->post('/add-item', [App\Http\Controllers\RawMaterialRequestController::class, 'addItem'])->name('raw_material_request.addItem');
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->post('/delete-item', [App\Http\Controllers\RawMaterialRequestController::class, 'deleteItem'])->name('raw_material_request.deleteItem');
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/view-table', [App\Http\Controllers\RawMaterialRequestController::class, 'viewCartTable'])->name('raw_material_request.viewCartTable');


        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/getStockItem', [App\Http\Controllers\RawMaterialRequestController::class, 'getStockItem'])->name('raw_material_request.getStockItem');
    });
    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('raw_material_request_approve')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'index'])->name('raw_material_request_approve.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin|Production Admin'])->get('/create', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'create'])->name('raw_material_request_approve.create');
        Route::middleware(['role:Super Admin|Admin|Production Admin|Production Admin'])->post('/create', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'store'])->name('raw_material_request_approve.store');
        Route::middleware(['role:Super Admin|Admin|Production Admin|Production Admin'])->get('/view-table', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'viewCartTable'])->name('raw_material_request_approve.viewCartTable');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('purchase_order')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase_order.index');
        Route::get('/create', [PurchaseOrderController::class, 'create'])->name('purchase_order.create');
        Route::post('/create', [App\Http\Controllers\PurchaseOrderController::class, 'store'])->name('purchase_order.store');
        Route::get('/get-items', [App\Http\Controllers\PurchaseOrderController::class, 'getPrfItems'])->name('purchase_order.getPrfItems');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('FinishedGoods')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('FinishedGoods', [App\Http\Controllers\FinishedGoodsController::class, 'index'])->name('finishedgoods.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [FinishedGoodsController::class, 'create'])->name('finishedgoods.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [App\Http\Controllers\FinishedGoodsController::class, 'store'])->name('finishedgoods.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/view/{$fgrn->id}', [App\Http\Controllers\FinishedGoodsController::class, 'view'])->name('finishedgoods.view');

        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-rmi-items', [App\Http\Controllers\FinishedGoodsController::class, 'getRmiItems'])->name('finishedgoods.getRmiItems');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/add-to-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'addToFinishGoodTable'])->name('finished_goods.addToFinishGoodTable');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/add-to-finish-good-table/bulk', [App\Http\Controllers\FinishedGoodsController::class, 'addToFinishGoodTableBulk'])->name('finished_goods.addToFinishGoodTableBulk');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/remove-from-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'removeFromFinishGoodTable'])->name('finishedgoods.removeFromFinishGoodTable');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'getFinishGoodTable'])->name('finishedgoods.getFinishGoodTable');

        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/add-to-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'addToWastageTable'])->name('finishedgoods.addToWastageTable');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/remove-from-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'removeFromWastageTable'])->name('finishedgoods.removeFromWastageTable');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'getWastageTable'])->name('finishedgoods.getWastageTable');

        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-total-calculations', [App\Http\Controllers\FinishedGoodsController::class, 'getTotalCalculations'])->name('finishedgoods.getTotalCalculations');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('FinishedGoodsApproval', [FinishedGoodsApprovalController::class, 'index'])->name('finished_goods_approval.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/inspect/{finished_good}', [FinishedGoodsApprovalController::class, 'create'])->name('finished_goods_approval.create');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->post('/inspect/{finished_good}', [FinishedGoodsApprovalController::class, 'store'])->name('finished_goods_approval.store');
    });

    // Route::middleware(['role:Super Admin|Admin'])->prefix('Disposal')->group(function () {
    //     Route::get('Disposal', [App\Http\Controllers\DisposalController::class, 'index'])->name('disposal.index');
    //     Route::get('/create', [DisposalController::class, 'create'])->name('disposal.create');
    //     Route::post('/create', [App\Http\Controllers\DisposalController::class, 'store'])->name('disposal.store');
    // });

    Route::middleware(['role:Super Admin|Admin'])->prefix('GoodsIssueNote')->group(function () {
        Route::get('GoodsIssueNote', [GoodsIssueNoteController::class, 'index'])->name('goodsissuenote.index');
        Route::get('/create', [App\Http\Controllers\GoodsIssueNoteController::class, 'create'])->name('goodsissuenote.create');
        Route::post('/create', [App\Http\Controllers\GoodsIssueNoteController::class, 'store'])->name('goodsissuenote.store');
    });

    Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin'])->prefix('goodsreceived')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin'])->get('goodsreceived', [App\Http\Controllers\GoodsReceivedController::class, 'index'])->name('goodsreceived.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User'])->get('/create', [App\Http\Controllers\GoodsReceivedController::class, 'create'])->name('goodsreceived.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User'])->post('/create', [App\Http\Controllers\GoodsReceivedController::class, 'store'])->name('goodsreceived.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User'])->get('/get-items', [App\Http\Controllers\GoodsReceivedController::class, 'getPoItems'])->name('goodsreceived.getPoItems');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User'])->get('/get-list', [App\Http\Controllers\GoodsReceivedController::class, 'getGrnList'])->name('goodsreceived.getGrnList');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('MaterialsReturnByCustomer')->group(function () {
        Route::get('MaterialsReturnByCustomer', [MaterialsReturnByCustomerController::class, 'index'])->name('materialsreturnbycustomer.index');
        Route::get('/create', [App\Http\Controllers\MaterialsReturnByCustomerController::class, 'create'])->name('materialsreturnbycustomer.create');
        Route::post('/create', [App\Http\Controllers\MaterialsReturnByCustomerController::class, 'store'])->name('materialsreturnbycustomer.store');
    });



    Route::middleware(['role:Super Admin|Admin'])->prefix('OverShortageAndDamage')->group(function () {
        Route::get('OverShortageAndDamage', [OverShortageAndDamageController::class, 'index'])->name('overshortanddamage.index');
        Route::get('/create', [App\Http\Controllers\OverShortageAndDamageController::class, 'create'])->name('overshortanddamage.create');
        Route::post('/create', [App\Http\Controllers\OverShortageAndDamageController::class, 'store'])->name('overshortanddamage.store');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('ProductionPlanningAndSchedule')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('ProductionPlanningAndSchedule', [ProductionPlanningAndScheduleController::class, 'index'])->name('productionplanningandschedule.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'create'])->name('productionplanningandschedule.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'store'])->name('productionplanningandschedule.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-items', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'getDfItems'])->name('productionplanningandschedule.getDfItems');

        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('approvals', [ProductionPlanningAndScheduleController::class, 'indexApproval'])->name('productionplanningandschedule.indexApproval');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('approvals/create', [ProductionPlanningAndScheduleController::class, 'storeApprovalIndex'])->name('productionplanningandschedule.storeApprovalIndex');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->post('approvals/create', [ProductionPlanningAndScheduleController::class, 'storeApproval'])->name('productionplanningandschedule.storeApproval');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('production-planning-and-schedule-approval')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('', [ProductionPlanningApprovalController::class, 'index'])->name('production_planning_and_schedule_approval.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/create', [ProductionPlanningApprovalController::class, 'create'])->name('production_planning_and_schedule_approval.create');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->post('/create', [ProductionPlanningApprovalController::class, 'store'])->name('production_planning_and_schedule_approval.store');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/get-items', [ProductionPlanningApprovalController::class, 'getItems'])->name('production_planning_and_schedule_approval.getItems');
    });

    Route::middleware(['role:Super Admin|Admin|Procurement User'])->prefix('pr_request_approve')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('', [PrApproveController::class, 'index'])->name('pr_request_approve.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [PrApproveController::class, 'create'])->name('pr_request_approve.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [PrApproveController::class, 'store'])->name('pr_request_approve.store');
        Route::middleware(['role:Super Admin|Admin'])->get('/get-items', [PrApproveController::class, 'getItems'])->name('pr_request_approve.getItems');
    });
    Route::middleware(['role:Super Admin|Admin|Procurement User'])->prefix('purchase_order_approve')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('', [PurchaseOrderMrApproveController::class, 'index'])->name('purchase_order_approve.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [PurchaseOrderMrApproveController::class, 'create'])->name('purchase_order_approve.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [PurchaseOrderMrApproveController::class, 'store'])->name('purchase_order_approve.store');
        Route::middleware(['role:Super Admin|Admin'])->get('/get-items', [PurchaseOrderMrApproveController::class, 'getItems'])->name('purchase_order_approve.getItems');
    });
    Route::middleware(['role:Super Admin|Admin'])->get('{item_id}/view', [PurchaseOrderMrApproveController::class, 'view'])->name('purchase_order_approve.view');

    Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin|Production User'])->prefix('rawmaterialsserialcodeassigning')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin|Production User'])->get('rawmaterialsserialcodeassigning', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'index'])->name('rawmaterialsserialcodeassigning.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin|Production User'])->get('/create', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'create'])->name('rawmaterialsserialcodeassigning.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin|Production User'])->post('/create', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'store'])->name('rawmaterialsserialcodeassigning.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin|Production User'])->get('/get-items', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'getGrnItems'])->name('rawmaterialsserialcodeassigning.getGrnItems');
    });

    Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->prefix('RawMaterialIssueForProduction')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->get('RawMaterialIssueForProduction', [RawMaterialIssueForProductionController::class, 'index'])->name('rawmaterialissueforproduction.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->get('/create', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'create'])->name('rawmaterialissueforproduction.create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->post('/create', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'store'])->name('rawmaterialissueforproduction.store');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->get('/get-semi-product-serials', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'getSemiProductSerials'])->name('rawmaterialissueforproduction.getSemiProductSerials');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->post('/add-item', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'addItem'])->name('rawmaterialissueforproduction.addItem');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->post('/delete-item', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'deleteItem'])->name('rawmaterialissueforproduction.deleteItem');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Warehouse Admin|Factory Warehouse User|Factory Admin|Production Admin'])->get('/view-table', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'viewCartTable'])->name('rawmaterialissueforproduction.viewCartTable');
    });



    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('RawMaterialReceivedForProduction')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('RawMaterialReceivedForProduction', [RawMaterialReceivedController::class, 'index'])->name('rawmaterial_received_for_production.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [RawMaterialReceivedController::class, 'create'])->name('rawmaterial_received_for_production.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [RawMaterialReceivedController::class, 'store'])->name('rawmaterial_received_for_production.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-item-list', [RawMaterialReceivedController::class, 'getItemList'])->name('rawmaterial_received_for_production.getItemList');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('SemiProduction')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('SemiProduction', [SemiProductionController::class, 'index'])->name('semiproduction.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [App\Http\Controllers\SemiProductionController::class, 'create'])->name('semiproduction.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [App\Http\Controllers\SemiProductionController::class, 'store'])->name('semiproduction.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/loadSerial', [App\Http\Controllers\SemiProductionController::class, 'loadSerial'])->name('semiproduction.loadserial');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/delete', [App\Http\Controllers\SemiProductionController::class, 'deleteSessionItem'])->name('semiproduction.delete_item');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/addSemiProducts', [App\Http\Controllers\SemiProductionController::class, 'addSemiProducts'])->name('semiproduction.addSemiProducts');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/view-cart-table', [App\Http\Controllers\SemiProductionController::class, 'viewCartTable'])->name('semiproduction.viewCartTable');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get_next_semi_product_serial_no', [App\Http\Controllers\SemiProductionController::class, 'getNextSemiProductSerialNumber'])->name('semiproduction.getNextSemiProductSerialNumber');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('JobOrderCreation')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('JobOrderCreation', [JobOrderCreationController::class, 'index'])->name('jobordercreation.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [App\Http\Controllers\JobOrderCreationController::class, 'create'])->name('jobordercreation.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [App\Http\Controllers\JobOrderCreationController::class, 'store'])->name('jobordercreation.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-items', [App\Http\Controllers\JobOrderCreationController::class, 'getItems'])->name('jobordercreation.getItems');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('job-order-approval')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('', [JobOrderApprovalController::class, 'index'])->name('joborderapproval.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/create', [JobOrderApprovalController::class, 'create'])->name('joborderapproval.create');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->post('/create', [JobOrderApprovalController::class, 'store'])->name('joborderapproval.store');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/get-items', [JobOrderApprovalController::class, 'getItems'])->name('joborderapproval.getItems');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('ProductionWastage')->group(function () {
        Route::get('ProductionWastage', [ProductionWastageController::class, 'index'])->name('productionwastage.index');
        Route::get('/create', [App\Http\Controllers\ProductionWastageController::class, 'create'])->name('productionwastage.create');
        Route::post('/create', [App\Http\Controllers\ProductionWastageController::class, 'store'])->name('productionwastage.store');
    });

    Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin'])->prefix('Dispatch')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin'])->get('Dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User'])->get('/create', [App\Http\Controllers\DispatchController::class, 'create'])->name('dispatch.create');
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User'])->post('/create', [App\Http\Controllers\DispatchController::class, 'store'])->name('dispatch.store');

        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User'])->get('/get-fgrn-items', [App\Http\Controllers\DispatchController::class, 'getFgrnItems'])->name('dispatch.getFgrnItems');
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User'])->get('/get-calculations', [App\Http\Controllers\DispatchController::class, 'getCalculation'])->name('dispatch.getCalculation');
    });

    Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin'])->prefix('Dispatch-approval')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin'])->get('/', [DispatchApprovalController::class, 'index'])->name('dispatch_approval.index');
        Route::middleware(['role:Super Admin|Admin|Factory Admin'])->get('/create/{dispatch_item}', [DispatchApprovalController::class, 'create'])->name('dispatch_approval.create');
        Route::middleware(['role:Super Admin|Admin|Factory Admin'])->post('/create', [DispatchApprovalController::class, 'store'])->name('dispatch_approval.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('FinishedGoodsSerialCodeAssigning')->group(function () {
        Route::get('FinishedGoodsSerialCodeAssigning', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'index'])->name('finishedgoodsserialcodeassigning.index');
        Route::get('/create', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'create'])->name('finishedgoodsserialcodeassigning.create');
        Route::post('/create', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'store'])->name('finishedgoodsserialcodeassigning.store');
    });

    Route::middleware(['role:Super Admin|Admin|Warehouse User|Sale User|Sales Admin'])->prefix('BalanceOrder')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Sale User|Sales Admin'])->get('BalanceOrder', [App\Http\Controllers\BalanceOrderController::class, 'index'])->name('balanceorder.index');
        Route::middleware(['role:Super Admin|Admin|Warehouse User|Sale User|Sales Admin'])->get('{balance_order}/view', [App\Http\Controllers\BalanceOrderController::class, 'view'])->name('balanceorder.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('{balance_order}/delicery-order-create', [App\Http\Controllers\BalanceOrderController::class, 'deliveryOrderCreateIndex'])->name('balanceorder.delicery_order_create_index');
        Route::middleware(['role:Super Admin|Admin|Sale User|Sales Admin'])->post('{balance_order}/delicery-order-create', [App\Http\Controllers\BalanceOrderController::class, 'deliveryOrderCreate'])->name('balanceorder.delivery_order_create');
        Route::middleware(['role:Super Admin|Admin|Warehouse User'])->get('/{balance_order_id}/print', [App\Http\Controllers\BalanceOrderController::class, 'print'])->name('balanceorder.print');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('demand-forecasting')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/', [DfController::class, 'index'])->name('demand-forecasting.index');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/create', [App\Http\Controllers\DfController::class, 'create'])->name('demand-forecasting.create');
        Route::middleware(['role:Super Admin|Admin|Production User'])->post('/create', [App\Http\Controllers\DfController::class, 'store'])->name('demand-forecasting.store');
        Route::middleware(['role:Super Admin|Admin|Production User'])->get('/get-items', [App\Http\Controllers\DfController::class, 'getMrfItems'])->name('demand-forecasting.getMrfItems');
    });

    Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->prefix('demand-forecast-approve')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production User|Production Admin'])->get('/', [App\Http\Controllers\DfApprovalController::class, 'index'])->name('df_approve.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/create', [App\Http\Controllers\DfApprovalController::class, 'create'])->name('df_approve.create');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->post('/create', [App\Http\Controllers\DfApprovalController::class, 'store'])->name('df_approve.store');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/get-items', [App\Http\Controllers\DfApprovalController::class, 'getDfApprovedItems'])->name('df_approve.getDfApprovedItems');
        Route::middleware(['role:Super Admin|Admin|Production Admin'])->get('/get-df', [App\Http\Controllers\DfApprovalController::class, 'getDfData'])->name('df_approve.getDfData');
    });



    Route::middleware(['role:Super Admin|Admin'])->prefix('SemiFinishedGoodsSerialCodeAssigning')->group(function () {
        Route::get('SemiFinishedGoodsSerialCodeAssigning', [SemiFinishedGoodsSerialCodeAssigningController::class, 'index'])->name('semifinishedgoodsserialcodeassigning.index');
        Route::get('/create', [App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController::class, 'create'])->name('semifinishedgoodsserialcodeassigning.create');
        Route::post('/create', [App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController::class, 'store'])->name('semifinishedgoodsserialcodeassigning.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('WarehouseAreaDesign')->group(function () {
        Route::get('WarehouseAreaDesign', [WarehouseAreaDesignController::class, 'index'])->name('warehouseareadesign.index');
        Route::get('/create', [App\Http\Controllers\WarehouseAreaDesignController::class, 'create'])->name('warehouseareadesign.create');
        Route::post('/create', [App\Http\Controllers\WarehouseAreaDesignController::class, 'store'])->name('warehouseareadesign.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('StorageArea')->group(function () {
        Route::get('StorageArea', [StorageAreaController::class, 'index'])->name('storagearea.index');
        Route::get('/create', [App\Http\Controllers\StorageAreaController::class, 'create'])->name('storagearea.create');
        Route::post('/create', [App\Http\Controllers\StorageAreaController::class, 'store'])->name('storagearea.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('WarehouseSafety')->group(function () {
        Route::get('WarehouseSafety', [WarehouseSafetyController::class, 'index'])->name('warehousesafety.index');
        Route::get('/create', [App\Http\Controllers\WarehouseSafetyController::class, 'create'])->name('warehousesafety.create');
        Route::post('/create', [App\Http\Controllers\WarehouseSafetyController::class, 'store'])->name('warehousesafety.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('ManAndEquipmentSafety')->group(function () {
        Route::get('ManAndEquipmentSafety', [ManAndEquipmentSafetyController::class, 'index'])->name('manandequipmentsafety.index');
        Route::get('/create', [App\Http\Controllers\ManAndEquipmentSafetyController::class, 'create'])->name('manandequipmentsafety.create');
        Route::post('/create', [App\Http\Controllers\ManAndEquipmentSafetyController::class, 'store'])->name('manandequipmentsafety.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('EquipmentMaintenance')->group(function () {
        Route::get('EquipmentMaintenance', [App\Http\Controllers\EquipmentMaintenanceController::class, 'index'])->name('equipmentmaintenance.index');
        Route::get('/create', [App\Http\Controllers\EquipmentMaintenanceController::class, 'create'])->name('equipmentmaintenance.create');
        Route::post('/create', [App\Http\Controllers\EquipmentMaintenanceController::class, 'store'])->name('equipmentmaintenance.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('ProductionCost')->group(function () {
        Route::get('ProductionCost', [ProductionCostController::class, 'index'])->name('productioncost.index');
        Route::get('/create', [App\Http\Controllers\ProductionCostController::class, 'create'])->name('productioncost.create');
        Route::post('/create', [App\Http\Controllers\ProductionCostController::class, 'store'])->name('productioncost.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('OperationMachanismProductionAndTimeManagement')->group(function () {
        Route::get('OperationMachanismProductionAndTimeManagement', [OperationMachanismProductionAndTimeManagementController::class, 'index'])->name('operationmachanismproductionandtimemanagement.index');
        Route::get('/create', [App\Http\Controllers\OperationMachanismProductionAndTimeManagementController::class, 'create'])->name('operationmachanismproductionandtimemanagement.create');
        Route::post('/create', [App\Http\Controllers\OperationMachanismProductionAndTimeManagementController::class, 'store'])->name('operationmachanismproductionandtimemanagement.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('PlantTimeManagement')->group(function () {
        Route::get('PlantTimeManagement', [PlantTimeManagementController::class, 'index'])->name('planttimemanagement.index');
        Route::get('/create', [App\Http\Controllers\PlantTimeManagementController::class, 'create'])->name('planttimemanagement.create');
        Route::post('/create', [App\Http\Controllers\PlantTimeManagementController::class, 'store'])->name('planttimemanagement.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('OperationMechanismByProduct')->group(function () {
        Route::get('OperationMechanismByProduct', [OperationMechanismByProductController::class, 'index'])->name('operationmechanismbyproduct.index');
        Route::get('/create', [App\Http\Controllers\OperationMechanismByProductController::class, 'create'])->name('operationmechanismbyproduct.create');
        Route::post('/create', [App\Http\Controllers\OperationMechanismByProductController::class, 'store'])->name('operationmechanismbyproduct.store');
    });
    Route::middleware(['role:Super Admin|Admin|Procurement User'])->prefix('mrfprf')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/', [App\Http\Controllers\MrfPrfController::class, 'index'])->name('mrfprf.index');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/create', [App\Http\Controllers\MrfPrfController::class, 'create'])->name('mrfprf.create');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->post('/create', [App\Http\Controllers\MrfPrfController::class, 'store'])->name('mrfprf.store');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/get-items', [App\Http\Controllers\MrfPrfController::class, 'getMrfItems'])->name('mrfprf.getMrfItems');
    });

    Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin|Production Admin'])->prefix('material-request-approve')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Factory Warehouse User|Factory Admin|Production Admin'])->get('/', [App\Http\Controllers\MrApproveController::class, 'index'])->name('mr_request_approve.index');
        Route::middleware(['role:Super Admin|Admin|Factory Admin|Production Admin'])->get('/create', [App\Http\Controllers\MrApproveController::class, 'create'])->name('mr_request_approve.create');
        Route::middleware(['role:Super Admin|Admin|Factory Admin|Production Admin'])->post('/create', [App\Http\Controllers\MrApproveController::class, 'store'])->name('mr_request_approve.store');
        Route::middleware(['role:Super Admin|Admin|Factory Admin|Production Admin'])->get('/get-items', [App\Http\Controllers\MrApproveController::class, 'getMrfItems'])->name('mr_request_approve.getMrfItems');
    });

    Route::middleware(['role:Super Admin|Admin|Procurement User'])->prefix('purchase_order_mr')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/', [App\Http\Controllers\PurchaseOrderMrController::class, 'index'])->name('purchase_order_mr.index');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/create', [App\Http\Controllers\PurchaseOrderMrController::class, 'create'])->name('purchase_order_mr.create');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->post('/create', [App\Http\Controllers\PurchaseOrderMrController::class, 'store'])->name('purchase_order_mr.store');
        Route::middleware(['role:Super Admin|Admin|Procurement User'])->get('/get-items', [App\Http\Controllers\PurchaseOrderMrController::class, 'getMrfPrfItems'])->name('purchase_order_mr.getMrfPrfItems');
    });
    // This belongs to modal
    Route::middleware(['role:Super Admin|Admin|Production Admin|Production User'])->prefix('raw-material-code-assign')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Production Admin|Production User'])->get('/', [App\Http\Controllers\RawMaterialCodeController::class, 'index'])->name('raw_material_code_assign.index');
        Route::middleware(['role:Super Admin|Admin|Production Admin|Production User'])->post('/store', [App\Http\Controllers\RawMaterialCodeController::class, 'store'])->name('raw_material_code_assign.store');
        Route::post('/delete', [App\Http\Controllers\RawMaterialCodeController::class, 'delete'])->name('raw_material_code_assign.delete');
    });

    Route::get('/test/inovice-items', function () {
        return App\Models\InvoiceItem::where('invoice_number', "BT002000001")->get()->groupBy('location_id')->toArray();
    });


    Route::prefix('users')->group(function () {
        //Only for needed routes
        Route::middleware('role:Super Admin')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'new'])->name('users.new');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/update/{user}', [UserController::class, 'indexUpdate'])->name('users.indexUpdate');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::get('/delete/{user}', [UserController::class, 'delete'])->name('users.delete');
        });

        Route::get('/password-chanege', [UserController::class, 'passwordChangeIndex'])->name('users.passwordChangeIndex');
        Route::post('/password-chanege/{user}', [UserController::class, 'passwordChange'])->name('users.passwordChange');
    });
    Route::prefix('sales_order')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('sales_order', [SalesOrderController::class, 'index'])->name('sales_order.index');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/{invoice_id}/view', [SalesOrderController::class, 'view'])->name('sales_order.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/{invoice_id}/print', [SalesOrderController::class, 'print'])->name('sales_order.print');
    });

    Route::prefix('credit_note')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/', [CreditNoteController::class, 'index'])->name('credit_note.index');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/create', [App\Http\Controllers\CreditNoteController::class, 'create'])->name('credit_note.create');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('/store', [App\Http\Controllers\CreditNoteController::class, 'store'])->name('credit_note.store');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->post('/getInvoiceDetails', [App\Http\Controllers\CreditNoteController::class, 'getInvDetails'])->name('creditnote.getInvoiceDetails');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/getNonIssues', [App\Http\Controllers\CreditNoteController::class, 'nonIssues'])->name('creditnote.getNonIssues');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/getReturnItems', [App\Http\Controllers\CreditNoteController::class, 'getReturn'])->name('creditnote.getReturnItems');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin'])->get('/getBalanceOrders', [App\Http\Controllers\CreditNoteController::class, 'getBalanceItems'])->name('creditnote.getBalanceOrders');
    });

    Route::prefix('credit_note_Approval')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/', [CreditNoteApprovalController::class, 'index'])->name('credit_note_approval.index');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/create', [App\Http\Controllers\CreditNoteApprovalController::class, 'create'])->name('credit_note_approval.create');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->post('/store', [App\Http\Controllers\CreditNoteApprovalController::class, 'store'])->name('credit_note_approval.store');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->post('/getCreditNoteDetails', [App\Http\Controllers\CreditNoteApprovalController::class, 'getCnDetails'])->name('credit_note_approval.getCreditNoteDetails');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/getCnItems', [App\Http\Controllers\CreditNoteApprovalController::class, 'getCnItems'])->name('credit_note_approval.getCnItems');
    });

    Route::prefix('credit_note_print')->group(function () {
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/', [CreditNotePrintController::class, 'index'])->name('credit_note_print.index');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/{creditnote_id}/view', [CreditNotePrintController::class, 'view'])->name('credit_note_print.view');
        Route::middleware(['role:Super Admin|Admin|Sales User|Sales Admin|Executive User'])->get('/{creditnote_id}/print', [CreditNotePrintController::class, 'print'])->name('credit_note_print.print');
    });

    Route::middleware(['role:Super Admin|Admin|Executive User'])->prefix('customerpayment')->group(function () {
        Route::get('/index', [CustomerPaymentUpdateController::class, 'index'])->name('customerpayment.index');
        Route::get('/create', [CustomerPaymentUpdateController::class, 'create'])->name('customerpayment.create');
        Route::post('/create', [CustomerPaymentUpdateController::class, 'store'])->name('customerpayment.store');
        Route::post('/getCustomerDetails', [CustomerPaymentUpdateController::class, 'getCusDetails'])->name('customerpayment.getCustomerDetails');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('creditlimtlog')->group(function () {
        Route::get('/index', [CreditLimitLogContrller::class, 'index'])->name('creditlimtlog.index');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('MaterialsReturnReports')->group(function () {
        Route::get('MaterialsReturnReports', [MrsReportController::class, 'index'])->name('mrsreports.index');
        Route::post('filter', [MrsReportController::class, 'filter'])->name('mrsreports.filter');
        //Route::post('date_filter', [MrsReportController::class, 'date_filter'])->name('mrsreports.date_filter');
        // Route::get('/create', [App\Http\Controllers\MrsReportController::class, 'create'])->name('materialsreturnbycustomer.create');
        // Route::post('/create', [App\Http\Controllers\MrsReportController::class, 'store'])->name('materialsreturnbycustomer.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('StockReports')->group(function () {
        Route::get('/', [StockReportController::class, 'index'])->name('stockreports.index');
        Route::post('item_wise', [StockReportController::class, 'generate_history_report'])->name('stockreports.generate_history_report');
        //Route::post('date_filter', [MrsReportController::class, 'date_filter'])->name('mrsreports.date_filter');
        // Route::get('/create', [App\Http\Controllers\MrsReportController::class, 'create'])->name('materialsreturnbycustomer.create');
        // Route::post('/create', [App\Http\Controllers\MrsReportController::class, 'store'])->name('materialsreturnbycustomer.store');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('internal_issue')->group(function () {
        Route::middleware(['role:Super Admin|Admin'])->get('/', [InternalIssueController::class, 'index'])->name('internal_issue.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [InternalIssueController::class, 'create'])->name('internal_issue.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [InternalIssueController::class, 'store'])->name('internal_issue.store');
        Route::middleware(['role:Super Admin|Admin'])->get('internal_issue/delete/{index}', [InternalIssueController::class, 'deleteSessionItem'])->name('internal_issue.delete_item');
        Route::middleware(['role:Super Admin|Admin'])->get('/{internal_issue}/view', [InternalIssueController::class, 'view'])->name('internal_issue.view');

        Route::middleware(['role:Super Admin|Admin '])->get('/approval', [InternalIssueController::class, 'approvalIndex'])->name('internal_issue.approvalIndex');
        Route::middleware(['role:Super Admin|Admin '])->post('{internal_issue}/approval', [InternalIssueController::class, 'approval'])->name('internal_issue.approval');
    });
    Route::middleware(['role:Super Admin|Admin'])->prefix('BalanceOrder')->group(function () {
        Route::get('/', [BalanceOrderReportController::class, 'index'])->name('BalanceOrder.index');
        Route::post('date_wise', [BalanceOrderReportController::class, 'date_filter'])->name('BalanceOrder.datewise_balance_order_report');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('Sfgrn')->group(function () {
        Route::middleware(['role:Super Admin|Admin'])->get('/', [SfgrnController::class, 'index'])->name('Sfgrn.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [SfgrnController::class, 'create'])->name('Sfgrn.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [SfgrnController::class, 'store'])->name('Sfgrn.store');
        Route::middleware(['role:Super Admin|Admin'])->get('/view/{$fgrn->id}', [SfgrnController::class, 'view'])->name('Sfgrn.view');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('StockLoctionChange')->group(function () {
        Route::get('/', [StockLocationChangeReportController::class, 'index'])->name('StockLoctionChange.index');
        Route::post('date_wise', [StockLocationChangeReportController::class, 'date_filter'])->name('StockLoctionChange.datewise_slc_report');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('reverse_delivery')->group(function () {
        Route::middleware(['role:Super Admin|Admin'])->get('/', [App\Http\Controllers\ReverseDeliveryOrderController::class, 'index'])->name('reverse_delivery.index');
        Route::middleware(['role:Super Admin|Admin'])->get('/create', [App\Http\Controllers\ReverseDeliveryOrderController::class, 'create'])->name('reverse_delivery.create');
        Route::middleware(['role:Super Admin|Admin'])->post('/create', [App\Http\Controllers\ReverseDeliveryOrderController::class, 'store'])->name('reverse_delivery.store');
        Route::middleware(['role:Super Admin|Admin'])->get('reverse_delivery/delete/{index}', [ReverseDeliveryOrderController::class, 'deleteSessionItem'])->name('reverse_delivery.delete_item');
    });

    Route::middleware(['role:Super Admin|Admin'])->prefix('urgent_invoice')->group(function () {
        Route::get('/', [UrgentInvoiceController::class, 'index'])->name('urgent_invoice.index');
        Route::get('/create', [App\Http\Controllers\UrgentInvoiceController::class, 'create'])->name('urgent_invoice.create');
        Route::post('/create', [App\Http\Controllers\UrgentInvoiceController::class, 'store'])->name('urgent_invoice.store');
        Route::get('/get/invoice_no', [App\Http\Controllers\UrgentInvoiceController::class, 'generateInvoiceNumber'])->name('urgent_invoice.get.number');
    });
});
