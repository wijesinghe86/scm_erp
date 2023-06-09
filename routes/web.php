<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MrfPrfController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\BillTypeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\DisposalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MrequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MrApproveController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DfApprovalController;
use App\Http\Controllers\StorageAreaController;
use App\Http\Controllers\TaxCreationController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\DispatchApprovalController;
use App\Http\Controllers\FinishedGoodsController;
use App\Http\Controllers\GoodsReceivedController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\GoodsIssueNoteController;
use App\Http\Controllers\ProductionCostController;
use App\Http\Controllers\SemiProductionController;
use App\Http\Controllers\InvoiceSettingsController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\PurchaseOrderMrController;
use App\Http\Controllers\RawMaterialCodeController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\WarehouseSafetyController;
use App\Http\Controllers\JobOrderCreationController;
use App\Http\Controllers\FleetRegistrationController;
use App\Http\Controllers\LocationBayDesigncontroller;
use App\Http\Controllers\LocationRowDesignController;
use App\Http\Controllers\PlantRegistrationController;
use App\Http\Controllers\ProductionWastageController;
use App\Http\Controllers\LocationRackDesignController;
use App\Http\Controllers\RawMaterialRequestController;
use App\Http\Controllers\LocationShelfDesignController;
use App\Http\Controllers\MiscellaneousIssuedController;
use App\Http\Controllers\PlantTimeManagementController;
use App\Http\Controllers\StockLocationChangeController;
use App\Http\Controllers\WarehouseAreaDesignController;
use App\Http\Controllers\EquipmentRegistrationController;
use App\Http\Controllers\FinishedGoodsApprovalController;
use App\Http\Controllers\JobOrderApprovalController;
use App\Http\Controllers\ManAndEquipmentSafetyController;
use App\Http\Controllers\MiscellaneousReceivedController;
use App\Http\Controllers\OverShortageAndDamageController;
use App\Http\Controllers\MaterialsReturnByCustomerController;
use App\Http\Controllers\RawMaterialRequestApproveController;
use App\Http\Controllers\OperationMechanismByProductController;
use App\Http\Controllers\ProductionPlanningAndScheduleController;
use App\Http\Controllers\RawMaterialIssueForProductionController;
use App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController;
use App\Http\Controllers\OperationMachanismProductionAndTimeManagementController;
use App\Http\Controllers\ProductionPlanningApprovalController;
use App\Http\Controllers\RawMaterialReceivedController;

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
Auth::routes();

// Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::get('cart/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

// Master Files-------
/* .....CREATING ROUTE FOR Customer Creation ....... */
Route::prefix('customer')->group(function () {
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    Route::get('/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
    Route::post('/create', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
    Route::get('/{customer_id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/{customer_id}/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
    Route::get('/{customer_id}/delete', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('/deleted', [App\Http\Controllers\CustomerController::class, 'deleted'])->name('customer.deleted');
    Route::get('/{customer_id}/restore', [App\Http\Controllers\CustomerController::class, 'restore'])->name('customer.restore');
    Route::get('/{customer_id}/delete/force', [App\Http\Controllers\CustomerController::class, 'deleteForce'])->name('customer.forcedelete');
    Route::get('/{customer_id}', [App\Http\Controllers\CustomerController::class, 'view'])->name('customer.view');
    Route::get('/{customer_id}/active', [App\Http\Controllers\CustomerController::class, 'active'])->name('customer.active');
    Route::get('/{customer_id}/deactive', [App\Http\Controllers\CustomerController::class, 'deactive'])->name('customer.deactive');
    Route::get('/print', [App\Http\Controllers\CustomerController::class, 'print'])->name('customer.print');
    Route::get('/get/data', [CustomerController::class, 'getData'])->name('customer.get.data');
});

/* .....CREATING ROUTE FOR Supplier Registration ....... */
Route::prefix('supplier')->group(function () {
    Route::get('supplier', [SupplierController::class, 'all'])->name('supplier.all');
    Route::get('/new', [SupplierController::class, 'new'])->name('supplier.new');
    Route::post('/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/{supplier_id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/{supplier_id}/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/{supplier_id}/delete', [SupplierController::class, 'delete'])->name('supplier.delete');
    Route::get('/deleted', [SupplierController::class, 'deleted'])->name('supplier.deleted');
    Route::get('/{supplier_id}/restore', [SupplierController::class, 'restore'])->name('supplier.restore');
    Route::get('/{supplier_id}/delete/force', [SupplierController::class, 'deleteForce'])->name('supplier.delete.force');
    Route::get('/{supplier_id}', [SupplierController::class, 'view'])->name('supplier.view');
    Route::get('/{supplier_id}/active', [SupplierController::class, 'active'])->name('supplier.active');
    Route::get('/{supplier_id}/deactive', [SupplierController::class, 'deactive'])->name('supplier.deactive');
    Route::get('/get/data', [SupplierController::class, 'getData'])->name('supplier.get.data');
});

/* .....CREATING ROUTE FOR Stock Item Creation ....... */
Route::prefix('stockitem')->group(function () {
    Route::get('stockitem', [App\Http\Controllers\StockItemController::class, 'all'])->name('stockitem.all');
    Route::get('/create', [App\Http\Controllers\StockItemController::class, 'create'])->name('stockitem.create');
    Route::post('/create', [App\Http\Controllers\StockItemController::class, 'store'])->name('stockitem.store');
    Route::get('/{stockitem_id}/edit', [App\Http\Controllers\StockItemController::class, 'edit'])->name('stockitem.edit');
    Route::post('/{stockitem_id}/update', [App\Http\Controllers\StockItemController::class, 'update'])->name('stockitem.update');
    Route::get('/{stockitem_id}/delete', [App\Http\Controllers\StockItemController::class, 'delete'])->name('stockitem.delete');
    Route::get('/deleted', [App\Http\Controllers\StockItemController::class, 'deleted'])->name('stockitem.deleted');
    Route::post('/{stockitem_id}/restore', [App\Http\Controllers\StockItemController::class, 'restore'])->name('stockitem.restore');
    Route::get('/{stockitem_id}/delete/force', [App\Http\Controllers\StockItemController::class, 'deleteforce'])->name('stockitem.delete.force');
    Route::get('/{stockitem_id}', [App\Http\Controllers\StockItemController::class, 'view'])->name('stockitem.view');
    Route::get('/get/data', [App\Http\Controllers\StockItemController::class, 'getData'])->name('stockitem.get.data');
    Route::get('/{stockitem_id}/active', [App\Http\Controllers\StockItemController::class, 'active'])->name('stockitem.active');
    Route::get('/{stockitem_id}/deactive', [App\Http\Controllers\StockItemController::class, 'deactive'])->name('stockitem.deactive');
});

/* .....CREATING ROUTE FOR Warehouse Creation ....... */
Route::prefix('warehouse')->group(function () {
    Route::get('warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('/create', [App\Http\Controllers\WarehouseController::class, 'create'])->name('warehouse.create');
    Route::post('/create', [App\Http\Controllers\WarehouseController::class, 'store'])->name('warehouse.store');
    Route::get('/{warehouse_id}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::post('/{warehouse_id}/update', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::get('/{warehouse_id}/delete', [WarehouseController::class, 'delete'])->name('warehouse.delete');
    Route::get('/deleted', [WarehouseController::class, 'deleted'])->name('warehouse.deleted');
    Route::get('/{warehouse_id}/restore', [WarehouseController::class, 'restore'])->name('warehouse.restore');
    Route::get('/{warehouse_id}/delete/force', [WarehouseController::class, 'deleteforce'])->name('warehouse.delete.force');
    Route::get('/{warehouse_id}/view', [WarehouseController::class, 'view'])->name('warehouse.view');
    Route::get('/get/data', [WarehouseController::class, 'getData'])->name('warehouse.get.data');
    Route::get('/{warehouse_id}/active', [WarehouseController::class, 'active'])->name('warehouse.active');
    Route::get('/{warehouse_id}/deactive', [WarehouseController::class, 'deactive'])->name('warehouse.deactive');
});
/* .....CREATING ROUTE FOR Stock Adjustment ....... */
Route::prefix('StockAdjustment')->group(function () {
    Route::get('/', [StockAdjustmentController::class, 'index'])->name('stockadjustment.index');
    Route::get('/create', [StockAdjustmentController::class, 'create'])->name('stockadjustment.create');
    Route::post('/create', [StockAdjustmentController::class, 'store'])->name('stockadjustment.store');

    Route::post('/add-to-table', [StockAdjustmentController::class, 'addToTable'])->name('stockadjustment.addToTable');
    Route::post('/remove-from-table', [StockAdjustmentController::class, 'removeFromTable'])->name('stockadjustment.removeFromTable');
    Route::get('/view-table', [StockAdjustmentController::class, 'viewTable'])->name('stockadjustment.viewTable');

    Route::get('/approval/{stock_adjustment}', [StockAdjustmentController::class, 'approvalIndex'])->name('stockadjustment.approvalIndex');
    Route::post('/approval/{stock_adjustment}', [StockAdjustmentController::class, 'approval'])->name('stockadjustment.approval');

});

/* .....CREATING ROUTE FOR Location Bay Design ....... */
Route::prefix('locationbaydesign')->group(function () {
    Route::get('locationbaydesign', [App\Http\Controllers\LocationBayDesignController::class, 'index'])->name('locationbaydesign.index');
    Route::get('/create', [App\Http\Controllers\LocationBayDesignController::class, 'create'])->name('locationbaydesign.create');
    Route::post('/create', [App\Http\Controllers\LocationBayDesignController::class, 'store'])->name('locationbaydesign.store');
    Route::get('/{locationbaydesign_id}/edit', [App\Http\Controllers\LocationBayDesignController::class, 'edit'])->name('locationbaydesign.edit');
    Route::post('/{locationbaydesign_id}/update', [App\Http\Controllers\LocationBayDesignController::class, 'update'])->name('locationbaydesign.update');
    Route::get('/{locationbaydesign_id}/delete', [App\Http\Controllers\LocationBayDesignController::class, 'delete'])->name('locationbaydesign.delete');
    Route::get('/deleted', [App\Http\Controllers\LocationBayDesignController::class, 'deleted'])->name('locationbaydesign.deleted');
    Route::get('/{locationbaydesign_id}/restore', [App\Http\Controllers\LocationBayDesignController::class, 'restore'])->name('locationbaydesign.restore');
    Route::post('/{locationbaydesign_id}/delete/force', [App\Http\Controllers\LocationBayDesignController::class, 'deleteforce'])->name('locationbaydesign.delete.force');
    Route::get('/{locationbaydesign_id}/view', [App\Http\Controllers\LocationBayDesignController::class, 'view'])->name('locationbaydesign.view');
    Route::get('/get/data', [App\Http\Controllers\LocationBayDesignController::class, 'getData'])->name('locationbaydesign.get.data');
    Route::get('/{locationbaydesign_id}/active', [App\Http\Controllers\LocationBayDesignController::class, 'active'])->name('locationbaydesign.active');
    Route::get('/{locationbaydesign_id}/deactive', [App\Http\Controllers\LocationBayDesignController::class, 'deactive'])->name('locationbaydesign.deactive');
});

/* .....CREATING ROUTE FOR plant Registration ....... */
Route::prefix('PlantRegistration')->group(function () {
    Route::get('PlantRegistration', [App\Http\Controllers\PlantRegistrationController::class, 'index'])->name('PlantRegistration.index');
    Route::get('/create', [App\Http\Controllers\PlantRegistrationController::class, 'create'])->name('PlantRegistration.create');
    Route::post('/create', [App\Http\Controllers\PlantRegistrationController::class, 'store'])->name('PlantRegistration.store');
    Route::get('/{plantregistration_id}/edit', [App\Http\Controllers\PlantRegistrationController::class, 'edit'])->name('plantregistration.edit');
    Route::post('/{plantregistration_id}/update', [App\Http\Controllers\PlantRegistrationController::class, 'update'])->name('plantregistration.update');
    Route::get('/{plantregistration_id}/delete', [App\Http\Controllers\PlantRegistrationController::class, 'delete'])->name('plantregistration.delete');
    Route::get('/deleted', [App\Http\Controllers\PlantRegistrationController::class, 'deleted'])->name('plantregistration.deleted');
    Route::get('/{plantregistration_id}/restore', [App\Http\Controllers\PlantRegistrationController::class, 'restore'])->name('plantregistration.restore');
    Route::get('/{plantregistration_id}/delete/force', [App\Http\Controllers\PlantRegistrationController::class, 'deleteforce'])->name('plantregistration.delete.force');
    Route::get('/{plantregistration_id}/view', [App\Http\Controllers\PlantRegistrationController::class, 'view'])->name('plantregistration.view');
    Route::get('/get/data', [App\Http\Controllers\PlantRegistrationController::class, 'getData'])->name('plantregistration.get.data');
    Route::get('/{plantregistration_id}/active', [App\Http\Controllers\PlantRegistrationController::class, 'active'])->name('plantregistration.active');
    Route::get('/{plantregistration_id}/deactive', [App\Http\Controllers\PlantRegistrationController::class, 'deactive'])->name('plantregistration.deactive');
});

/* .....CREATING ROUTE FOR Employee Registration ....... */
Route::prefix('Employee')->group(function () {
    Route::get('/', [App\Http\Controllers\EmployeeController::class, 'all'])->name('employee.all');
    Route::get('/new', [EmployeeController::class, 'new'])->name('employee.new');
    Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/{employee_id}/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/{employee_id}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::get('/deleted', [EmployeeController::class, 'deleted'])->name('employee.deleted');
    Route::get('/{employee_id}/restore', [EmployeeController::class, 'restore'])->name('employee.restore');
    Route::get('/{employee_id}/delete/force', [EmployeeController::class, 'deleteForce'])->name('employee.delete.force');
    Route::get('/{employee_id}', [EmployeeController::class, 'view'])->name('employee.view');
    Route::get('/{employee_id}/active', [EmployeeController::class, 'active'])->name('employee.active');
    Route::get('/{employee_id}/deactive', [EmployeeController::class, 'deactive'])->name('employee.deactive');
    /*........Create this route to get department and section from Employee to the MR request....*/
    Route::get('/get/data', [EmployeeController::class, 'getData'])->name('employee.get.data');
});

/* .....CREATING ROUTE FOR Department Registration ....... */
Route::prefix('Department')->group(function () {
    Route::get('Department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
    Route::get('/create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.create');
    Route::post('/create', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    Route::get('/{department_id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/{department_id}/update', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/{department_id}/delete', [DepartmentController::class, 'delete'])->name('department.delete');
    Route::get('/deleted', [App\Http\Controllers\DepartmentController::class, 'deleted'])->name('department.deleted');
    Route::get('/{department_id}/restore', [App\Http\Controllers\DepartmentController::class, 'restore'])->name('department.restore');
    Route::get('/{department_id}/delete/force', [App\Http\Controllers\DepartmentController::class, 'deleteforce'])->name('department.delete.force');
    Route::get('/{department_id}/view', [App\Http\Controllers\DepartmentController::class, 'view'])->name('department.view');
    Route::get('/get/data', [App\Http\Controllers\DepartmentController::class, 'getData'])->name('department.get.data');
    Route::get('/{department_id}/active', [App\Http\Controllers\DepartmentController::class, 'active'])->name('department.active');
    Route::get('/{department_id}/deactive', [App\Http\Controllers\DepartmentController::class, 'deactive'])->name('department.deactive');
});

/* .....CREATING ROUTE FOR Tax Creation ....... */
Route::prefix('TaxCreation')->group(function () {
    Route::get('TaxCreation', [App\Http\Controllers\TaxCreationController::class, 'index'])->name('taxcreation.index');
    Route::get('/create', [App\Http\Controllers\TaxCreationController::class, 'create'])->name('taxcreation.create');
    Route::post('/create', [App\Http\Controllers\TaxCreationController::class, 'store'])->name('taxcreation.store');
    Route::get('/{taxcreation_id}/edit', [TaxCreationController::class, 'edit'])->name('taxcreation.edit');
    Route::post('/{taxcreation_id}/update', [TaxCreationController::class, 'update'])->name('taxcreation.update');
    Route::get('/{taxcreation_id}/delete', [TaxCreationController::class, 'delete'])->name('taxcreation.delete');
    Route::get('/deleted', [TaxCreationController::class, 'deleted'])->name('taxcreation.deleted');
    Route::get('/{taxcreation_id}/restore', [TaxCreationController::class, 'restore'])->name('taxcreation.restore');
    Route::get('/{taxcreation_id}/delete/force', [TaxCreationController::class, 'deleteforce'])->name('taxcreation.delete.force');
    Route::get('/{taxcreation_id}/view', [TaxCreationController::class, 'view'])->name('taxcreation.view');
    Route::get('/get/data', [App\Http\Controllers\TaxCreationController::class, 'getData'])->name('taxcreation.get.data');
    Route::get('/{taxcreation_id}/active', [App\Http\Controllers\TaxCreationController::class, 'active'])->name('taxcreation.active');
    Route::get('/{taxcreation_id}/deactive', [App\Http\Controllers\TaxCreationController::class, 'deactive'])->name('taxcreation.deactive');
});

/* .....CREATING ROUTE FOR Fleet Registration ....... */
Route::prefix('FleetRegistration')->group(function () {
    Route::get('FleetRegistration', [App\Http\Controllers\FleetRegistrationController::class, 'index'])->name('fleetregistration.index');
    Route::get('/create', [App\Http\Controllers\FleetRegistrationController::class, 'create'])->name('fleetregistration.create');
    Route::post('/create', [App\Http\Controllers\FleetRegistrationController::class, 'store'])->name('fleetregistration.store');
    Route::get('/{fleetregistration_id}/edit', [App\Http\Controllers\FleetRegistrationController::class, 'edit'])->name('fleetregistration.edit');
    Route::post('/{fleetregistration_id}/update', [App\Http\Controllers\FleetRegistrationController::class, 'update'])->name('fleetregistration.update');
    Route::get('/{fleetregistration_id}/delete', [App\Http\Controllers\FleetRegistrationController::class, 'delete'])->name('fleetregistration.delete');
    Route::get('/deleted', [App\Http\Controllers\FleetRegistrationController::class, 'deleted'])->name('fleetregistration.deleted');
    Route::get('/{fleetregistration_id}/restore', [App\Http\Controllers\FleetRegistrationController::class, 'restore'])->name('fleetregistration.restore');
    Route::get('/{fleetregistration_id}/delete/force', [App\Http\Controllers\FleetRegistrationController::class, 'deleteforce'])->name('fleetregistration.delete.force');
    Route::get('/{fleetregistration_id}/view', [App\Http\Controllers\FleetRegistrationController::class, 'view'])->name('fleetregistration.view');
    Route::get('/get/data', [App\Http\Controllers\FleetRegistrationController::class, 'getData'])->name('fleetregistration.get.data');
    Route::get('/{fleetregistration_id}/active', [App\Http\Controllers\FleetRegistrationController::class, 'active'])->name('fleetregistration.active');
    Route::get('/{fleetregistration_id}/deactive', [App\Http\Controllers\FleetRegistrationController::class, 'deactive'])->name('fleetregistration.deactive');
});

/* .....CREATING ROUTE FOR Equipment Registration ....... */
Route::prefix('EquipmentRegistration')->group(function () {
    Route::get('EquipmentRegistration', [App\Http\Controllers\EquipmentRegistrationController::class, 'index'])->name('equipmentregistration.index');
    Route::get('/create', [App\Http\Controllers\EquipmentRegistrationController::class, 'create'])->name('equipmentregistration.create');
    Route::post('/create', [App\Http\Controllers\EquipmentRegistrationController::class, 'store'])->name('equipmentregistration.store');
    Route::get('/{equipmentregistration_id}/edit', [App\Http\Controllers\EquipmentRegistrationController::class, 'edit'])->name('equipmentregistration.edit');
    Route::post('/{equipmentregistration_id}/update', [App\Http\Controllers\EquipmentRegistrationController::class, 'update'])->name('equipmentregistration.update');
    Route::get('/{equipmentregistration_id}/delete', [App\Http\Controllers\EquipmentRegistrationController::class, 'delete'])->name('equipmentregistration.delete');
    Route::get('/deleted', [App\Http\Controllers\EquipmentRegistrationController::class, 'deleted'])->name('equipmentregistration.deleted');
    Route::get('/{equipmentregistration_id}/restore', [App\Http\Controllers\EquipmentRegistrationController::class, 'restore'])->name('equipmentregistration.restore');
    Route::get('/{equipmentregistration_id}/delete/force', [App\Http\Controllers\EquipmentRegistrationController::class, 'deleteforce'])->name('equipmentregistration.delete.force');
    Route::get('/{equipmentregistration_id}/view', [App\Http\Controllers\EquipmentRegistrationController::class, 'view'])->name('equipmentregistration.view');
    Route::get('/get/data', [App\Http\Controllers\EquipmentRegistrationController::class, 'getData'])->name('equipmentregistration.get.data');
    Route::get('/{equipmentregistration_id}/active', [App\Http\Controllers\EquipmentRegistrationController::class, 'active'])->name('equipmentregistration.active');
    Route::get('/{equipmentregistration_id}/deactive', [App\Http\Controllers\EquipmentRegistrationController::class, 'deactive'])->name('equipmentregistration.deactive');
});

/* .....CREATING ROUTE FOR Section Creation ....... */
Route::prefix('Section')->group(function () {
    Route::get('Section', [App\Http\Controllers\SectionController::class, 'index'])->name('section.index');
    Route::get('/create', [App\Http\Controllers\SectionController::class, 'create'])->name('section.create');
    Route::post('/create', [App\Http\Controllers\SectionController::class, 'store'])->name('section.store');
    Route::get('/{section_id}/edit', [App\Http\Controllers\SectionController::class, 'edit'])->name('section.edit');
    Route::post('/{section_id}/update', [App\Http\Controllers\SectionController::class, 'update'])->name('section.update');
    Route::get('/{section_id}/delete', [App\Http\Controllers\SectionController::class, 'delete'])->name('section.delete');
    Route::get('/deleted', [App\Http\Controllers\SectionController::class, 'deleted'])->name('section.deleted');
    Route::get('/{section_id}/restore', [App\Http\Controllers\SectionController::class, 'restore'])->name('section.restore');
    Route::get('/{section_id}/delete/force', [App\Http\Controllers\SectionController::class, 'deleteforce'])->name('section.delete.force');
    Route::get('/{section_id}/view', [App\Http\Controllers\SectionController::class, 'view'])->name('section.view');
    Route::get('/get/data', [App\Http\Controllers\SectionController::class, 'getData'])->name('section.get.data');
    Route::get('/{section_id}/active', [App\Http\Controllers\SectionController::class, 'active'])->name('section.active');
    Route::get('/{section_id}/deactive', [App\Http\Controllers\SectionController::class, 'deactive'])->name('section.deactive');
});

/* .....CREATING ROUTE FOR BILL TYPES Creation ....... */
Route::prefix('billtypes')->group(function () {
    Route::get('/', [BillTypeController::class, 'all'])->name('billtypes.all');
    Route::get('/new', [BillTypeController::class, 'new'])->name('billtypes.new');
    Route::get('/{billtype_Id}', [BillTypeController::class, 'get'])->name('billtypes.get');
    Route::post('/store', [BillTypeController::class, 'store'])->name('billtypes.store');
});

Route::prefix('Locationrowdesign')->group(function () {
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

Route::prefix('LocationRackDesign')->group(function () {
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

Route::prefix('LocationShelfDesign')->group(function () {
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
Route::get('purchase-request', [App\Http\Controllers\PurchasingRequestController::class, 'index'])->name('purchase_request.index');
Route::get('purchase-request/create', [App\Http\Controllers\PurchasingRequestController::class, 'create'])->name('purchase_request.create');
Route::post('purchase-request/create', [App\Http\Controllers\PurchasingRequestController::class, 'store'])->name('purchase_request.store');
Route::get('purchase-request/delete/{index}', [App\Http\Controllers\PurchasingRequestController::class, 'deleteSessionItem'])->name('purchase_request.delete_item');

/* .....CREATING ROUTE FOR InvoiceSetting ....... */
Route::prefix('invoicesettings')->group(function () {
    Route::get('/', [InvoiceSettingsController::class, 'all'])->name('invoicesettings.all');
    Route::post('/update', [InvoiceSettingsController::class, 'update'])->name('invoicesettings.update');
});

// Sales and Marketing
/* .....CREATING ROUTE FOR Invoice ....... */
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'all'])->name('invoices.all');
    Route::get('/new', [InvoiceController::class, 'new'])->name('invoices.new');
    Route::post('/new', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::post('/item/store', [InvoiceController::class, 'storeItem'])->name('invoices.item.store');
    Route::post('/item/delete', [InvoiceController::class, 'deleteItem'])->name('invoices.item.delete');
    Route::get('/get/items/table', [InvoiceController::class, 'itemsTable'])->name('invoices.item.table');
    Route::get('/{invoice_id}/preview', [InvoiceController::class, 'preview'])->name('invoices.preview');
    Route::get('/{invoice_id}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::get('/get/data', [InvoiceController::class, 'getData'])->name('invoices.get.data');
    Route::get('/get/total', [InvoiceController::class, 'getInvoiceTotal'])->name('invoices.get.total');
});

/* .....CREATING ROUTE FOR Delivery Order ....... */
Route::prefix('deliveryorders')->group(function () {
    Route::get('/', [DeliveryOrderController::class, 'all'])->name('deliveryorders.all');
    Route::get('/new', [DeliveryOrderController::class, 'new'])->name('deliveryorders.new');
    Route::post('/new', [DeliveryOrderController::class, 'store'])->name('deliveryorders.store');
    Route::get('/{delivery_order}/view', [DeliveryOrderController::class, 'view'])->name('deliveryorders.view');
    Route::get('/get-items', [DeliveryOrderController::class, 'getInvoiceItems'])->name('deliveryorders.getInvoiceItems');
    Route::get('/{delivery_order}/issue_delivery_order', [DeliveryOrderController::class, 'issueIndex'])->name('deliveryorders.issueIndex');
    Route::post('/{delivery_order}/issue_delivery_order', [DeliveryOrderController::class, 'issueStore'])->name('deliveryorders.issueStore');
    Route::get('/{delivery_order}/get', [DeliveryOrderController::class, 'getById'])->name('deliveryorders.getById');
    Route::get('/{delivery_order_id}/print', [DeliveryOrderController::class, 'print'])->name('deliveryorders.print');
});

Route::prefix('returns')->group(function () {
    Route::get('/', [ReturnController::class, 'all'])->name('returns.all');
    Route::get('/new', [ReturnController::class, 'new'])->name('returns.new');
    Route::post('/new', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/{invoice_return}/view', [ReturnController::class, 'view'])->name('returns.view');

    Route::get('/approval', [ReturnController::class, 'approvalIndex'])->name('returns.approvalIndex');
    Route::post('{invoice_return}/approval', [ReturnController::class, 'approval'])->name('returns.approval');
});

// Inventory Control
/* .....CREATING ROUTE FOR Miscellaneous Received ....... */
Route::prefix('miscreceived')->group(function () {
    Route::get('/', [MiscellaneousReceivedController::class, 'index'])->name('miscreceived.index');
    Route::get('/create', [MiscellaneousReceivedController::class, 'create'])->name('miscreceived.create');
    Route::post('/create', [MiscellaneousReceivedController::class, 'store'])->name('miscreceived.store');
    Route::post('/item/store', [MiscellaneousReceivedController::class, 'storeItem'])->name('miscreceived.item.store');
    Route::get('/get/items/table', [MiscellaneousReceivedController::class, 'itemsTable'])->name('miscreceived.item.table');
});

/* .....CREATING ROUTE FOR Miscellaneous Issued ....... */
Route::prefix('miscissued')->group(function () {
    Route::get('/', [MiscellaneousIssuedController::class, 'index'])->name('miscissued.index');
    Route::get('/create', [MiscellaneousIssuedController::class, 'create'])->name('miscissued.create');
    Route::post('/create', [MiscellaneousIssuedController::class, 'store'])->name('miscissued.store');
    Route::post('/item/store', [MiscellaneousIssuedController::class, 'storeItem'])->name('miscissued.item.store');
    Route::get('/get/items/table', [MiscellaneousIssuedController::class, 'itemsTable'])->name('miscissued.item.table');
});


/* .....CREATING ROUTE FOR Stock Location Change ....... */
Route::prefix('StockLocationChange')->group(function () {
    Route::get('/', [StockLocationChangeController::class, 'index'])->name('stocklocationchange.index');
    Route::get('/create', [StockLocationChangeController::class, 'create'])->name('stocklocationchange.create');
    Route::post('/create', [StockLocationChangeController::class, 'store'])->name('stocklocationchange.store');
    Route::post('/add-to-table', [StockLocationChangeController::class, 'addItemToTable'])->name('stocklocationchange.addItemToTable');
    Route::post('/remove-from-table', [StockLocationChangeController::class, 'removeItemFromTable'])->name('stocklocationchange.removeItemFromTable');
    Route::get('/view-table', [StockLocationChangeController::class, 'getItemTable'])->name('stocklocationchange.getItemTable');


    Route::get('/approvals', [StockLocationChangeController::class, 'approvalIndex'])->name('stocklocationchange_approvals.index');
    Route::get('/approvals/{slc}/create', [StockLocationChangeController::class, 'approvalCreateIndex'])->name('stocklocationchange_approvals.create');
    Route::post('/approvals/{slc}/create', [StockLocationChangeController::class, 'approvalStore'])->name('stocklocationchange_approvals.store');

    Route::get('/received', [StockLocationChangeController::class, 'receivedIndex'])->name('stocklocationchange_received.index');
    Route::get('/received/{slc}/create', [StockLocationChangeController::class, 'receivedCreateIndex'])->name('stocklocationchange_received.create');
    Route::post('/received/{slc}/create', [StockLocationChangeController::class, 'receivedStore'])->name('stocklocationchange_received.store');
});

Route::prefix('material_request')->group(function () {
    Route::get('/', [App\Http\Controllers\MaterialRequestController::class, 'index'])->name('material_request.index');
    Route::get('/create', [App\Http\Controllers\MaterialRequestController::class, 'create'])->name('material_request.create');
    Route::post('/create', [App\Http\Controllers\MaterialRequestController::class, 'store'])->name('material_request.store');
    Route::get('material_request/delete/{index}', [MaterialRequestController::class, 'deleteSessionItem'])->name('material_request.delete_item');
});

Route::prefix('raw_material_request')->group(function () {
    Route::get('/', [App\Http\Controllers\RawMaterialRequestController::class, 'index'])->name('raw_material_request.index');
    Route::get('/create', [App\Http\Controllers\RawMaterialRequestController::class, 'create'])->name('raw_material_request.create');
    Route::post('/create', [App\Http\Controllers\RawMaterialRequestController::class, 'store'])->name('raw_material_request.store');
    Route::post('/add-item', [App\Http\Controllers\RawMaterialRequestController::class, 'addItem'])->name('raw_material_request.addItem');
    Route::post('/delete-item', [App\Http\Controllers\RawMaterialRequestController::class, 'deleteItem'])->name('raw_material_request.deleteItem');
    Route::get('/view-table', [App\Http\Controllers\RawMaterialRequestController::class, 'viewCartTable'])->name('raw_material_request.viewCartTable');

    
    Route::get('/getStockItem', [App\Http\Controllers\RawMaterialRequestController::class, 'getStockItem'])->name('raw_material_request.getStockItem');
});
Route::prefix('raw_material_request_approve')->group(function () {
    Route::get('/', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'index'])->name('raw_material_request_approve.index');
    Route::get('/create', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'create'])->name('raw_material_request_approve.create');
    Route::post('/create', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'store'])->name('raw_material_request_approve.store');
    Route::get('/view-table', [App\Http\Controllers\RawMaterialRequestApproveController::class, 'viewCartTable'])->name('raw_material_request_approve.viewCartTable');
});

Route::prefix('purchase_order')->group(function () {
    Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase_order.index');
    Route::get('/create', [PurchaseOrderController::class, 'create'])->name('purchase_order.create');
    Route::post('/create', [App\Http\Controllers\PurchaseOrderController::class, 'store'])->name('purchase_order.store');
    Route::get('/get-items', [App\Http\Controllers\PurchaseOrderController::class, 'getPrfItems'])->name('purchase_order.getPrfItems');
});

Route::prefix('FinishedGoods')->group(function () {
    Route::get('FinishedGoods', [App\Http\Controllers\FinishedGoodsController::class, 'index'])->name('finishedgoods.index');
    Route::get('/create', [FinishedGoodsController::class, 'create'])->name('finishedgoods.create');
    Route::post('/create', [App\Http\Controllers\FinishedGoodsController::class, 'store'])->name('finishedgoods.store');

    Route::get('/get-rmi-items', [App\Http\Controllers\FinishedGoodsController::class, 'getRmiItems'])->name('finishedgoods.getRmiItems');
    Route::post('/add-to-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'addToFinishGoodTable'])->name('finished_goods.addToFinishGoodTable');
    Route::post('/remove-from-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'removeFromFinishGoodTable'])->name('finishedgoods.removeFromFinishGoodTable');
    Route::get('/get-finish-good-table', [App\Http\Controllers\FinishedGoodsController::class, 'getFinishGoodTable'])->name('finishedgoods.getFinishGoodTable');

    Route::post('/add-to-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'addToWastageTable'])->name('finishedgoods.addToWastageTable');
    Route::post('/remove-from-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'removeFromWastageTable'])->name('finishedgoods.removeFromWastageTable');
    Route::get('/get-wastage-table', [App\Http\Controllers\FinishedGoodsController::class, 'getWastageTable'])->name('finishedgoods.getWastageTable');

    Route::get('/get-total-calculations', [App\Http\Controllers\FinishedGoodsController::class, 'getTotalCalculations'])->name('finishedgoods.getTotalCalculations');
});

Route::prefix('FinishedGoodsApproval')->group(function () {
    Route::get('FinishedGoodsApproval', [FinishedGoodsApprovalController::class, 'index'])->name('finished_goods_approval.index');
    Route::get('/inspect/{finished_good}', [FinishedGoodsApprovalController::class, 'create'])->name('finished_goods_approval.create');
    Route::post('/inspect/{finished_good}', [FinishedGoodsApprovalController::class, 'store'])->name('finished_goods_approval.store');
});

Route::prefix('Disposal')->group(function () {
    Route::get('Disposal', [App\Http\Controllers\DisposalController::class, 'index'])->name('disposal.index');
    Route::get('/create', [DisposalController::class, 'create'])->name('disposal.create');
    Route::post('/create', [App\Http\Controllers\DisposalController::class, 'store'])->name('disposal.store');
});

Route::prefix('GoodsIssueNote')->group(function () {
    Route::get('GoodsIssueNote', [GoodsIssueNoteController::class, 'index'])->name('goodsissuenote.index');
    Route::get('/create', [App\Http\Controllers\GoodsIssueNoteController::class, 'create'])->name('goodsissuenote.create');
    Route::post('/create', [App\Http\Controllers\GoodsIssueNoteController::class, 'store'])->name('goodsissuenote.store');
});

Route::prefix('goodsreceived')->group(function () {
    Route::get('goodsreceived', [App\Http\Controllers\GoodsReceivedController::class, 'index'])->name('goodsreceived.index');
    Route::get('/create', [App\Http\Controllers\GoodsReceivedController::class, 'create'])->name('goodsreceived.create');
    Route::post('/create', [App\Http\Controllers\GoodsReceivedController::class, 'store'])->name('goodsreceived.store');
    Route::get('/get-items', [App\Http\Controllers\GoodsReceivedController::class, 'getPoItems'])->name('goodsreceived.getPoItems');
    Route::get('/get-list', [App\Http\Controllers\GoodsReceivedController::class, 'getGrnList'])->name('goodsreceived.getGrnList');
});

Route::prefix('MaterialsReturnByCustomer')->group(function () {
    Route::get('MaterialsReturnByCustomer', [MaterialsReturnByCustomerController::class, 'index'])->name('materialsreturnbycustomer.index');
    Route::get('/create', [App\Http\Controllers\MaterialsReturnByCustomerController::class, 'create'])->name('materialsreturnbycustomer.create');
    Route::post('/create', [App\Http\Controllers\MaterialsReturnByCustomerController::class, 'store'])->name('materialsreturnbycustomer.store');
});

Route::prefix('OverShortageAndDamage')->group(function () {
    Route::get('OverShortageAndDamage', [OverShortageAndDamageController::class, 'index'])->name('overshortanddamage.index');
    Route::get('/create', [App\Http\Controllers\OverShortageAndDamageController::class, 'create'])->name('overshortanddamage.create');
    Route::post('/create', [App\Http\Controllers\OverShortageAndDamageController::class, 'store'])->name('overshortanddamage.store');
});

Route::prefix('ProductionPlanningAndSchedule')->group(function () {
    Route::get('ProductionPlanningAndSchedule', [ProductionPlanningAndScheduleController::class, 'index'])->name('productionplanningandschedule.index');
    Route::get('/create', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'create'])->name('productionplanningandschedule.create');
    Route::post('/create', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'store'])->name('productionplanningandschedule.store');
    Route::get('/get-items', [App\Http\Controllers\ProductionPlanningAndScheduleController::class, 'getDfItems'])->name('productionplanningandschedule.getDfItems');

    Route::get('approvals', [ProductionPlanningAndScheduleController::class, 'indexApproval'])->name('productionplanningandschedule.indexApproval');
    Route::get('approvals/create', [ProductionPlanningAndScheduleController::class, 'storeApprovalIndex'])->name('productionplanningandschedule.storeApprovalIndex');
    Route::post('approvals/create', [ProductionPlanningAndScheduleController::class, 'storeApproval'])->name('productionplanningandschedule.storeApproval');
});

Route::prefix('production-planning-and-schedule-approval')->group(function () {
    Route::get('', [ProductionPlanningApprovalController::class, 'index'])->name('production_planning_and_schedule_approval.index');
    Route::get('/create', [ProductionPlanningApprovalController::class, 'create'])->name('production_planning_and_schedule_approval.create');
    Route::post('/create', [ProductionPlanningApprovalController::class, 'store'])->name('production_planning_and_schedule_approval.store');
    Route::get('/get-items', [ProductionPlanningApprovalController::class, 'getItems'])->name('production_planning_and_schedule_approval.getItems');
});

Route::prefix('rawmaterialsserialcodeassigning')->group(function () {
    Route::get('rawmaterialsserialcodeassigning', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'index'])->name('rawmaterialsserialcodeassigning.index');
    Route::get('/create', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'create'])->name('rawmaterialsserialcodeassigning.create');
    Route::post('/create', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'store'])->name('rawmaterialsserialcodeassigning.store');
    Route::get('/get-items', [App\Http\Controllers\RawMaterialsSerialCodeAssigningController::class, 'getGrnItems'])->name('rawmaterialsserialcodeassigning.getGrnItems');
});

Route::prefix('RawMaterialIssueForProduction')->group(function () {
    Route::get('RawMaterialIssueForProduction', [RawMaterialIssueForProductionController::class, 'index'])->name('rawmaterialissueforproduction.index');
    Route::get('/create', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'create'])->name('rawmaterialissueforproduction.create');
    Route::post('/create', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'store'])->name('rawmaterialissueforproduction.store');
    Route::get('/get-semi-product-serials', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'getSemiProductSerials'])->name('rawmaterialissueforproduction.getSemiProductSerials');
    Route::post('/add-item', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'addItem'])->name('rawmaterialissueforproduction.addItem');
    Route::post('/delete-item', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'deleteItem'])->name('rawmaterialissueforproduction.deleteItem');
    Route::get('/view-table', [App\Http\Controllers\RawMaterialIssueForProductionController::class, 'viewCartTable'])->name('rawmaterialissueforproduction.viewCartTable');
});

Route::prefix('RawMaterialReceivedForProduction')->group(function () {
    Route::get('RawMaterialReceivedForProduction', [RawMaterialReceivedController::class, 'index'])->name('rawmaterial_received_for_production.index');
    Route::get('/create', [RawMaterialReceivedController::class, 'create'])->name('rawmaterial_received_for_production.create');
    Route::post('/create', [RawMaterialReceivedController::class, 'store'])->name('rawmaterial_received_for_production.store');
    Route::get('/get-item-list', [RawMaterialReceivedController::class, 'getItemList'])->name('rawmaterial_received_for_production.getItemList');
});

Route::prefix('SemiProduction')->group(function () {
    Route::get('SemiProduction', [SemiProductionController::class, 'index'])->name('semiproduction.index');
    Route::get('/create', [App\Http\Controllers\SemiProductionController::class, 'create'])->name('semiproduction.create');
    Route::post('/create', [App\Http\Controllers\SemiProductionController::class, 'store'])->name('semiproduction.store');
    Route::get('/loadSerial', [App\Http\Controllers\SemiProductionController::class, 'loadSerial'])->name('semiproduction.loadserial');
    Route::post('/delete', [App\Http\Controllers\SemiProductionController::class, 'deleteSessionItem'])->name('semiproduction.delete_item');
    Route::post('/addSemiProducts', [App\Http\Controllers\SemiProductionController::class, 'addSemiProducts'])->name('semiproduction.addSemiProducts');
    Route::get('/view-cart-table', [App\Http\Controllers\SemiProductionController::class, 'viewCartTable'])->name('semiproduction.viewCartTable');
    Route::get('/get_next_semi_product_serial_no', [App\Http\Controllers\SemiProductionController::class, 'getNextSemiProductSerialNumber'])->name('semiproduction.getNextSemiProductSerialNumber');
});

Route::prefix('JobOrderCreation')->group(function () {
    Route::get('JobOrderCreation', [JobOrderCreationController::class, 'index'])->name('jobordercreation.index');
    Route::get('/create', [App\Http\Controllers\JobOrderCreationController::class, 'create'])->name('jobordercreation.create');
    Route::post('/create', [App\Http\Controllers\JobOrderCreationController::class, 'store'])->name('jobordercreation.store');
    Route::get('/get-items', [App\Http\Controllers\JobOrderCreationController::class, 'getItems'])->name('jobordercreation.getItems');
});

Route::prefix('job-order-approval')->group(function () {
    Route::get('', [JobOrderApprovalController::class, 'index'])->name('joborderapproval.index');
    Route::get('/create', [JobOrderApprovalController::class, 'create'])->name('joborderapproval.create');
    Route::post('/create', [JobOrderApprovalController::class, 'store'])->name('joborderapproval.store');
    Route::get('/get-items', [JobOrderApprovalController::class, 'getItems'])->name('joborderapproval.getItems');
});

Route::prefix('ProductionWastage')->group(function () {
    Route::get('ProductionWastage', [ProductionWastageController::class, 'index'])->name('productionwastage.index');
    Route::get('/create', [App\Http\Controllers\ProductionWastageController::class, 'create'])->name('productionwastage.create');
    Route::post('/create', [App\Http\Controllers\ProductionWastageController::class, 'store'])->name('productionwastage.store');
});

Route::prefix('Dispatch')->group(function () {
    Route::get('Dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
    Route::get('/create', [App\Http\Controllers\DispatchController::class, 'create'])->name('dispatch.create');
    Route::post('/create', [App\Http\Controllers\DispatchController::class, 'store'])->name('dispatch.store');

    Route::get('/get-fgrn-items', [App\Http\Controllers\DispatchController::class, 'getFgrnItems'])->name('dispatch.getFgrnItems');
    Route::get('/get-calculations', [App\Http\Controllers\DispatchController::class, 'getCalculation'])->name('dispatch.getCalculation');
});

Route::prefix('Dispatch-approval')->group(function () {
    Route::get('/', [DispatchApprovalController::class, 'index'])->name('dispatch_approval.index');
    Route::get('/create/{dispatch_item}', [DispatchApprovalController::class, 'create'])->name('dispatch_approval.create');
    Route::post('/create', [DispatchApprovalController::class, 'store'])->name('dispatch_approval.store');
});

Route::prefix('FinishedGoodsSerialCodeAssigning')->group(function () {
    Route::get('FinishedGoodsSerialCodeAssigning', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'index'])->name('finishedgoodsserialcodeassigning.index');
    Route::get('/create', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'create'])->name('finishedgoodsserialcodeassigning.create');
    Route::post('/create', [App\Http\Controllers\FinishedGoodsSerialCodeAssigningController::class, 'store'])->name('finishedgoodsserialcodeassigning.store');
});

Route::prefix('BalanceOrder')->group(function () {
    Route::get('BalanceOrder', [App\Http\Controllers\BalanceOrderController::class, 'index'])->name('balanceorder.index');
    Route::get('{balance_order}/view', [App\Http\Controllers\BalanceOrderController::class, 'view'])->name('balanceorder.view');
    Route::get('{balance_order}/delicery-order-create', [App\Http\Controllers\BalanceOrderController::class, 'deliveryOrderCreateIndex'])->name('balanceorder.delicery_order_create_index');
    Route::post('{balance_order}/delicery-order-create', [App\Http\Controllers\BalanceOrderController::class, 'deliveryOrderCreate'])->name('balanceorder.delivery_order_create');
    Route::get('/{balance_order_id}/print', [App\Http\Controllers\BalanceOrderController::class, 'print'])->name('balanceorder.print');
});

Route::prefix('demand-forecasting')->group(function () {
    Route::get('/', [DfController::class, 'index'])->name('demand-forecasting.index');
    Route::get('/create', [App\Http\Controllers\DfController::class, 'create'])->name('demand-forecasting.create');
    Route::post('/create', [App\Http\Controllers\DfController::class, 'store'])->name('demand-forecasting.store');
    Route::get('/get-items', [App\Http\Controllers\DfController::class, 'getMrfItems'])->name('demand-forecasting.getMrfItems');
});

Route::prefix('demand-forecast-approve')->group(function () {
    Route::get('/', [App\Http\Controllers\DfApprovalController::class, 'index'])->name('df_approve.index');
    Route::get('/create', [App\Http\Controllers\DfApprovalController::class, 'create'])->name('df_approve.create');
    Route::post('/create', [App\Http\Controllers\DfApprovalController::class, 'store'])->name('df_approve.store');
    Route::get('/get-items', [App\Http\Controllers\DfApprovalController::class, 'getDfApprovedItems'])->name('df_approve.getDfApprovedItems');
    Route::get('/get-df', [App\Http\Controllers\DfApprovalController::class, 'getDfData'])->name('df_approve.getDfData');
});



Route::prefix('SemiFinishedGoodsSerialCodeAssigning')->group(function () {
    Route::get('SemiFinishedGoodsSerialCodeAssigning', [SemiFinishedGoodsSerialCodeAssigningController::class, 'index'])->name('semifinishedgoodsserialcodeassigning.index');
    Route::get('/create', [App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController::class, 'create'])->name('semifinishedgoodsserialcodeassigning.create');
    Route::post('/create', [App\Http\Controllers\SemiFinishedGoodsSerialCodeAssigningController::class, 'store'])->name('semifinishedgoodsserialcodeassigning.store');
});

Route::prefix('WarehouseAreaDesign')->group(function () {
    Route::get('WarehouseAreaDesign', [WarehouseAreaDesignController::class, 'index'])->name('warehouseareadesign.index');
    Route::get('/create', [App\Http\Controllers\WarehouseAreaDesignController::class, 'create'])->name('warehouseareadesign.create');
    Route::post('/create', [App\Http\Controllers\WarehouseAreaDesignController::class, 'store'])->name('warehouseareadesign.store');
});

Route::prefix('StorageArea')->group(function () {
    Route::get('StorageArea', [StorageAreaController::class, 'index'])->name('storagearea.index');
    Route::get('/create', [App\Http\Controllers\StorageAreaController::class, 'create'])->name('storagearea.create');
    Route::post('/create', [App\Http\Controllers\StorageAreaController::class, 'store'])->name('storagearea.store');
});

Route::prefix('WarehouseSafety')->group(function () {
    Route::get('WarehouseSafety', [WarehouseSafetyController::class, 'index'])->name('warehousesafety.index');
    Route::get('/create', [App\Http\Controllers\WarehouseSafetyController::class, 'create'])->name('warehousesafety.create');
    Route::post('/create', [App\Http\Controllers\WarehouseSafetyController::class, 'store'])->name('warehousesafety.store');
});

Route::prefix('ManAndEquipmentSafety')->group(function () {
    Route::get('ManAndEquipmentSafety', [ManAndEquipmentSafetyController::class, 'index'])->name('manandequipmentsafety.index');
    Route::get('/create', [App\Http\Controllers\ManAndEquipmentSafetyController::class, 'create'])->name('manandequipmentsafety.create');
    Route::post('/create', [App\Http\Controllers\ManAndEquipmentSafetyController::class, 'store'])->name('manandequipmentsafety.store');
});

Route::prefix('EquipmentMaintenance')->group(function () {
    Route::get('EquipmentMaintenance', [App\Http\Controllers\EquipmentMaintenanceController::class, 'index'])->name('equipmentmaintenance.index');
    Route::get('/create', [App\Http\Controllers\EquipmentMaintenanceController::class, 'create'])->name('equipmentmaintenance.create');
    Route::post('/create', [App\Http\Controllers\EquipmentMaintenanceController::class, 'store'])->name('equipmentmaintenance.store');
});

Route::prefix('ProductionCost')->group(function () {
    Route::get('ProductionCost', [ProductionCostController::class, 'index'])->name('productioncost.index');
    Route::get('/create', [App\Http\Controllers\ProductionCostController::class, 'create'])->name('productioncost.create');
    Route::post('/create', [App\Http\Controllers\ProductionCostController::class, 'store'])->name('productioncost.store');
});

Route::prefix('OperationMachanismProductionAndTimeManagement')->group(function () {
    Route::get('OperationMachanismProductionAndTimeManagement', [OperationMachanismProductionAndTimeManagementController::class, 'index'])->name('operationmachanismproductionandtimemanagement.index');
    Route::get('/create', [App\Http\Controllers\OperationMachanismProductionAndTimeManagementController::class, 'create'])->name('operationmachanismproductionandtimemanagement.create');
    Route::post('/create', [App\Http\Controllers\OperationMachanismProductionAndTimeManagementController::class, 'store'])->name('operationmachanismproductionandtimemanagement.store');
});

Route::prefix('PlantTimeManagement')->group(function () {
    Route::get('PlantTimeManagement', [PlantTimeManagementController::class, 'index'])->name('planttimemanagement.index');
    Route::get('/create', [App\Http\Controllers\PlantTimeManagementController::class, 'create'])->name('planttimemanagement.create');
    Route::post('/create', [App\Http\Controllers\PlantTimeManagementController::class, 'store'])->name('planttimemanagement.store');
});

Route::prefix('OperationMechanismByProduct')->group(function () {
    Route::get('OperationMechanismByProduct', [OperationMechanismByProductController::class, 'index'])->name('operationmechanismbyproduct.index');
    Route::get('/create', [App\Http\Controllers\OperationMechanismByProductController::class, 'create'])->name('operationmechanismbyproduct.create');
    Route::post('/create', [App\Http\Controllers\OperationMechanismByProductController::class, 'store'])->name('operationmechanismbyproduct.store');
});
Route::prefix('mrfprf')->group(function () {
    Route::get('/', [App\Http\Controllers\MrfPrfController::class, 'index'])->name('mrfprf.index');
    Route::get('/create', [App\Http\Controllers\MrfPrfController::class, 'create'])->name('mrfprf.create');
    Route::post('/create', [App\Http\Controllers\MrfPrfController::class, 'store'])->name('mrfprf.store');
    Route::get('/get-items', [App\Http\Controllers\MrfPrfController::class, 'getMrfItems'])->name('mrfprf.getMrfItems');
});

Route::prefix('material-request-approve')->group(function () {
    Route::get('/', [App\Http\Controllers\MrApproveController::class, 'index'])->name('mr_request_approve.index');
    Route::get('/create', [App\Http\Controllers\MrApproveController::class, 'create'])->name('mr_request_approve.create');
    Route::post('/create', [App\Http\Controllers\MrApproveController::class, 'store'])->name('mr_request_approve.store');
    Route::get('/get-items', [App\Http\Controllers\MrApproveController::class, 'getMrfItems'])->name('mr_request_approve.getMrfItems');
});

Route::prefix('purchase_order_mr')->group(function () {
    Route::get('/', [App\Http\Controllers\PurchaseOrderMrController::class, 'index'])->name('purchase_order_mr.index');
    Route::get('/create', [App\Http\Controllers\PurchaseOrderMrController::class, 'create'])->name('purchase_order_mr.create');
    Route::post('/create', [App\Http\Controllers\PurchaseOrderMrController::class, 'store'])->name('purchase_order_mr.store');
    Route::get('/get-items', [App\Http\Controllers\PurchaseOrderMrController::class, 'getMrfPrfItems'])->name('purchase_order_mr.getMrfPrfItems');
});
// This belongs to modal
Route::prefix('raw-material-code-assign')->group(function () {
    Route::get('/', [App\Http\Controllers\RawMaterialCodeController::class, 'index'])->name('raw_material_code_assign.index');
    Route::post('/store', [App\Http\Controllers\RawMaterialCodeController::class, 'store'])->name('raw_material_code_assign.store');
    Route::post('/delete', [App\Http\Controllers\RawMaterialCodeController::class, 'delete'])->name('raw_material_code_assign.delete');
});

Route::get('/test/inovice-items', function () {
    return App\Models\InvoiceItem::where('invoice_number', "BT002000001")->get()->groupBy('location_id')->toArray();
});
