<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BillType
 *
 * @property int $id
 * @property string $billtype_code
 * @property string $billtype_description
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|BillType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereBilltypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereBilltypeDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillType whereUpdatedAt($value)
 */
	class BillType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $customer_code
 * @property string|null $customer_name
 * @property string|null $customer_vat_number
 * @property string|null $customer_svat_number
 * @property string|null $customer_address_line1
 * @property string|null $customer_address_line2
 * @property int $customer_type_of_customer
 * @property string|null $customer_mobile_number
 * @property string|null $customer_fixed_phone_number
 * @property string|null $customer_email
 * @property int $customer_payment_terms
 * @property string|null $customer_credit_limit
 * @property int $customer_credit_period
 * @property string|null $customer_contact_person_name
 * @property string|null $customer_contact_person_mobile_number
 * @property string|null $customer_contact_person_email
 * @property int $customer_status
 * @property string|null $br_image
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @property-read \Illuminate\Foundation\Auth\User|null $deleteUser
 * @property-read \Illuminate\Foundation\Auth\User|null $updateUser
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBrImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerContactPersonEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerContactPersonMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerCreditPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerFixedPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerPaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerSvatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerTypeOfCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryOrder
 *
 * @property int $id
 * @property int|null $customer_id
 * @property string $delivery_order_no
 * @property string|null $invoice_number
 * @property string|null $invoice_date
 * @property string|null $issued_date
 * @property int|null $location_id
 * @property int $status
 * @property int|null $created_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\User|null $issuedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeliveryOrderItem> $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereDeliveryOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereIssuedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereUpdatedAt($value)
 */
	class DeliveryOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryOrderItem
 *
 * @property int $id
 * @property string $delivery_order_no
 * @property int $item_id
 * @property int $invoice_id
 * @property string|null $stock_no
 * @property string|null $description
 * @property string|null $uom
 * @property int $qty
 * @property int $available_qty
 * @property int $issued_qty
 * @property string|null $issued_date
 * @property string $unit_price
 * @property string $discount_percentage
 * @property string $discount_amount
 * @property string $sub_total
 * @property string $total
 * @property int|null $location
 * @property int|null $created_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereAvailableQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereDeliveryOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereIssuedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereIssuedQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrderItem whereUpdatedAt($value)
 */
	class DeliveryOrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DemandForecasting
 *
 * @property int $id
 * @property string|null $df_no
 * @property string|null $df_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting query()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting whereDfDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting whereDfNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecasting whereUpdatedAt($value)
 */
	class DemandForecasting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DemandForecastingItems
 *
 * @property int $id
 * @property int|null $stock_item_id
 * @property int|null $mr_id
 * @property string|null $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $df_id
 * @property-read \App\Models\StockItem|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereDfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereMrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemandForecastingItems whereUpdatedAt($value)
 */
	class DemandForecastingItems extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $department_number
 * @property string $department_name
 * @property string|null $department_description
 * @property string|null $remark
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $department_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDepartmentDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDepartmentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDepartmentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department withoutTrashed()
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string|null $employee_reg_no
 * @property string|null $employee_epf_no
 * @property string|null $employee_fullname
 * @property string|null $employee_name_with_intial
 * @property string|null $residential_address_line1
 * @property string|null $residential_address_line2
 * @property string|null $postal_address_line1
 * @property string|null $postal_address_line2
 * @property string|null $date_of_birth
 * @property int $gender
 * @property int $civil_status
 * @property string|null $employee_nic_no
 * @property string|null $employee_mobile_number
 * @property string|null $employee_residential_phone_number
 * @property string|null $employee_email
 * @property string $employee_type
 * @property string|null $section
 * @property string|null $department
 * @property string|null $join_date
 * @property string|null $last_date
 * @property string|null $designation
 * @property string|null $remark
 * @property string|null $role
 * @property string|null $responsibility
 * @property string|null $fleet_number
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $employee_status
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @property-read \App\Models\Department|null $departmentData
 * @property-read \App\Models\Section|null $sectionData
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCivilStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeEpfNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeNameWithIntial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeNicNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeRegNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeResidentialPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereFleetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereJoinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereLastDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePostalAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePostalAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereResidentialAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereResidentialAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereResponsibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee withoutTrashed()
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentRegistration
 *
 * @property int $id
 * @property string $equipment_code
 * @property string|null $stock_number
 * @property string|null $equipment_name
 * @property string|null $po_number
 * @property string|null $grn_number
 * @property string|null $equipment_description
 * @property int $equipment_type
 * @property int $power_source
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $equipment_registration_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereEquipmentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereEquipmentDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereEquipmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereEquipmentRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereEquipmentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereGrnNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration wherePoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration wherePowerSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereStockNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentRegistration withoutTrashed()
 */
	class EquipmentRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FleetRegistration
 *
 * @property int $id
 * @property string $fleet_number
 * @property string|null $fleet_name
 * @property string|null $fleet_registration_number
 * @property string|null $fleet_model_manufacture
 * @property int $category_of_fleet
 * @property string|null $current_meter_reading
 * @property int $type_of_fuel_consumption
 * @property string|null $loading_capacity
 * @property int $fleet_type
 * @property string|null $make
 * @property string|null $model
 * @property string|null $fleet_manufacture_year
 * @property string|null $colour
 * @property string|null $engine_capacity
 * @property string|null $engine_number
 * @property string|null $chassis_number
 * @property string|null $tax_period_from
 * @property string|null $tax_period_to
 * @property string|null $paid_amount
 * @property string|null $insured_company
 * @property string|null $insurance_policy
 * @property string|null $insurance_start_date
 * @property string|null $insurance_expire_date
 * @property string|null $amount
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fleet_registration_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereCategoryOfFleet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereChassisNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereCurrentMeterReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereEngineCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereEngineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetManufactureYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetModelManufacture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereFleetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereInsuranceExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereInsurancePolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereInsuranceStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereInsuredCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereLoadingCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereTaxPeriodFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereTaxPeriodTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereTypeOfFuelConsumption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FleetRegistration withoutTrashed()
 */
	class FleetRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoodsIssue
 *
 * @property int $id
 * @property int $customer_id
 * @property string $ref_number
 * @property string $issued_date
 * @property string $issued_number
 * @property int|null $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $Customer
 * @property-read \Illuminate\Foundation\Auth\User|null $UpdateUser
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereIssuedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereIssuedNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssue whereUpdatedAt($value)
 */
	class GoodsIssue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoodsIssueItem
 *
 * @property int $id
 * @property string $issued_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $iss_qty
 * @property string $iss_weight
 * @property int $location_id
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereIssQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereIssWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereIssuedNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsIssueItem whereUpdatedAt($value)
 */
	class GoodsIssueItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoodsReceived
 *
 * @property int $id
 * @property string|null $grn_no
 * @property string $grn_date
 * @property string|null $type
 * @property int|null $received_by
 * @property string|null $received_date
 * @property int|null $verified_by
 * @property string|null $verified_date
 * @property int|null $inspected_by
 * @property string|null $inspected_date
 * @property string|null $per_weight
 * @property string|null $tot_weight
 * @property string|null $per_volume
 * @property string|null $tot_volume
 * @property int|null $po_id
 * @property string|null $supplier_id
 * @property string|null $warehouse
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereGrnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereGrnNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereInspectedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereInspectedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived wherePerVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived wherePerWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived wherePoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereReceivedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereTotVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereTotWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereVerifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereVerifiedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceived whereWarehouse($value)
 */
	class GoodsReceived extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoodsReceivedItem
 *
 * @property int $id
 * @property int|null $grn_id
 * @property int|null $stock_item_id
 * @property string|null $rec_qty
 * @property string|null $rec_weight
 * @property string|null $batch_no
 * @property string|null $expiry_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StockItem|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereBatchNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereGrnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereRecQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereRecWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodsReceivedItem whereUpdatedAt($value)
 */
	class GoodsReceivedItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $customer_id
 * @property string $invoice_number
 * @property string $invoice_date
 * @property int $employee_id
 * @property string $ref_number
 * @property string $po_number
 * @property int $payment_terms
 * @property int $category
 * @property int $type
 * @property int $option
 * @property string $sub_total
 * @property string $vat
 * @property string $vat_amount
 * @property string $net_total
 * @property string $Total_discount_percentage
 * @property string $Total_discount_amount
 * @property string $grand_total
 * @property int|null $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $Customer
 * @property-read \App\Models\Employee|null $SalesStaff
 * @property-read \Illuminate\Foundation\Auth\User|null $UpdateUser
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereNetTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereVatAmount($value)
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InvoiceItem
 *
 * @property int $id
 * @property string $invoice_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $quantity
 * @property string $unit_price
 * @property string $item_discount_percentage
 * @property string $item_discount_amount
 * @property int $location_id
 * @property string $sub_total
 * @property string $total
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereItemDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereItemDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereUpdatedAt($value)
 */
	class InvoiceItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InvoiceSetting
 *
 * @property int $id
 * @property int $invoice_type
 * @property int|null $invoice_category
 * @property int $invoice_option
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BillType|null $category
 * @property-read mixed $invoice_type_name
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereInvoiceCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereInvoiceOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereInvoiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSetting whereUpdatedBy($value)
 */
	class InvoiceSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LocationRackDesign
 *
 * @property int $id
 * @property string|null $warehouse_code
 * @property string|null $bay_number
 * @property string|null $row_number
 * @property string $rack_number
 * @property string|null $rack_description
 * @property string $rack_height
 * @property string $rack_width
 * @property string $rack_length
 * @property string $rack_floor_area
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $location_rack_design_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereBayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereLocationRackDesignStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackFloorArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRackWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereRowNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRackDesign withoutTrashed()
 */
	class LocationRackDesign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LocationShelfDesign
 *
 * @property int $id
 * @property string|null $warehouse_code
 * @property string|null $bay_number
 * @property string|null $row_number
 * @property string|null $rack_number
 * @property string $shelf_number
 * @property string|null $shelf_description
 * @property string $shelf_height
 * @property string $shelf_width
 * @property string $shelf_length
 * @property string $shelf_floor_area
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $location_shelf_design_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereBayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereLocationShelfDesignStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereRackNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereRowNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfFloorArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereShelfWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationShelfDesign withoutTrashed()
 */
	class LocationShelfDesign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LocationRowDesign
 *
 * @property int $id
 * @property string|null $warehouse_code
 * @property string|null $bay_number
 * @property string $row_number
 * @property string|null $row_description
 * @property string $row_height
 * @property string $row_width
 * @property string $row_length
 * @property string $row_floor_area
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $locationrowdesign_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereBayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereLocationrowdesignStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowFloorArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereRowWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationRowDesign withoutTrashed()
 */
	class LocationRowDesign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MaterialRequest
 *
 * @property int $id
 * @property string|null $mrf_date
 * @property string|null $mrf_no
 * @property int|null $employee_id
 * @property int|null $created_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $justification
 * @property string|null $required_date
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DemandForecastingItems> $df_items
 * @property-read int|null $df_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MrApproved> $mr_approved
 * @property-read int|null $mr_approved_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MaterialRequestItem> $request_items
 * @property-read int|null $request_items_count
 * @property-read \App\Models\Employee|null $requested_by
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereJustification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereMrfDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereMrfNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereRequiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequest whereUpdatedAt($value)
 */
	class MaterialRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MaterialRequestItem
 *
 * @property int $id
 * @property int $mr_id
 * @property int $stock_item_id
 * @property string $priority
 * @property string $mrf_qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $remaining_qty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MrApproved> $approval
 * @property-read int|null $approval_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MrApproved> $approval_production
 * @property-read int|null $approval_production_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MrApproved> $approval_purchase
 * @property-read int|null $approval_purchase_count
 * @property-read \App\Models\StockItem|null $item
 * @property-read \App\Models\MaterialRequest|null $materialRequest
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem approvedForProduction()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem approvedForPurchase()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereMrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereMrfQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereRemainingQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialRequestItem whereUpdatedAt($value)
 */
	class MaterialRequestItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Miscellaneous
 *
 * @property int $id
 * @property int $customer_id
 * @property int $supplier_id
 * @property string $ref_number
 * @property string $misc_date
 * @property string $misc_number
 * @property int|null $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous query()
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereMiscDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereMiscNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Miscellaneous whereUpdatedAt($value)
 */
	class Miscellaneous extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MiscellaneousIssued
 *
 * @property int $id
 * @property string $misc_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $iss_qty
 * @property string $iss_weight
 * @property int $location_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $Customer
 * @property-read \Illuminate\Foundation\Auth\User|null $UpdateUser
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued query()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereIssQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereIssWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereMiscNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssued whereUpdatedAt($value)
 */
	class MiscellaneousIssued extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MiscellaneousIssuedItem
 *
 * @property-read \App\Models\Warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssuedItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssuedItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousIssuedItem query()
 */
	class MiscellaneousIssuedItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MiscellaneousReceived
 *
 * @property int $id
 * @property string $misc_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $rec_qty
 * @property string $rec_weight
 * @property int $location_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Supplier|null $Supplier
 * @property-read \Illuminate\Foundation\Auth\User|null $UpdateUser
 * @property-read \Illuminate\Foundation\Auth\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived query()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereMiscNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereRecQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereRecWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceived whereUpdatedAt($value)
 */
	class MiscellaneousReceived extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MiscellaneousReceivedItem
 *
 * @property-read \App\Models\Warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceivedItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceivedItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousReceivedItem query()
 */
	class MiscellaneousReceivedItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MrApproved
 *
 * @property int $id
 * @property int|null $mr_item_id
 * @property int|null $mr_id
 * @property int|null $item_id
 * @property string|null $qty
 * @property string|null $remaining_qty
 * @property string|null $status
 * @property string|null $approved_for
 * @property string|null $remark
 * @property int|null $requested_employee_id
 * @property int|null $created_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $created_by
 * @property-read \App\Models\StockItem|null $item
 * @property-read \App\Models\MaterialRequest|null $materialRequest
 * @property-read \App\Models\Employee|null $requested
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereApprovedFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereMrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereMrItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereRemainingQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereRequestedEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrApproved whereUpdatedAt($value)
 */
	class MrApproved extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MrPurchase
 *
 * @property int $id
 * @property string|null $po_no
 * @property int|null $prf_id
 * @property string|null $po_date
 * @property string|null $delivery_date
 * @property int|null $supplier_id
 * @property int|null $customer_id
 * @property int|null $po_type
 * @property string|null $weight_per_unit
 * @property string|null $volume_per_unit
 * @property string|null $total_weight
 * @property string|null $total_volume
 * @property int|null $created_by
 * @property int|null $edited_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereEditedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase wherePoDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase wherePoNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase wherePoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase wherePrfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereTotalVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereTotalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereVolumePerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchase whereWeightPerUnit($value)
 */
	class MrPurchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MrPurchaseItem
 *
 * @property int $id
 * @property int|null $item_id
 * @property int|null $po_id
 * @property string|null $po_qty
 * @property string|null $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StockItem|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem wherePoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem wherePoQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrPurchaseItem whereWeight($value)
 */
	class MrPurchaseItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MrfPrfItem
 *
 * @property int $id
 * @property int|null $stock_item_id
 * @property int|null $mr_id
 * @property string|null $prfqty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $prf_id
 * @property-read \App\Models\StockItem|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem whereMrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem wherePrfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem wherePrfqty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfItem whereUpdatedAt($value)
 */
	class MrfPrfItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MrfPrfMain
 *
 * @property int $id
 * @property string|null $mrfprf_no
 * @property string|null $mrfprf_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain whereMrfprfDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain whereMrfprfNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrfPrfMain whereUpdatedAt($value)
 */
	class MrfPrfMain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlantRegistration
 *
 * @property int $id
 * @property string $plant_number
 * @property string $plant_name
 * @property string $plant_type
 * @property string $plant_serial_number
 * @property string $model_number
 * @property string $manufactor_number
 * @property string $capacity
 * @property string $maintenance_period
 * @property string $technical_specification
 * @property string $electricalandelectronical_specification
 * @property string $electronic_specification
 * @property string $manual_operation_specification
 * @property string $maintaining_guide
 * @property string $operation_methods
 * @property string $analytical_manual
 * @property string $vendors_instruction_manual
 * @property string $safety_manual
 * @property string $purchase_date
 * @property string $po_number
 * @property string $grn_number
 * @property string $asset_code
 * @property int $warehouse_code
 * @property string $condition
 * @property string $tag_number
 * @property string $size
 * @property string $weight
 * @property string $output
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $plant_registration_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereAnalyticalManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereAssetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereElectricalandelectronicalSpecification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereElectronicSpecification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereGrnNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereMaintainingGuide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereMaintenancePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereManualOperationSpecification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereManufactorNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereModelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereOperationMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePlantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePlantNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePlantRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePlantSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePlantType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereSafetyManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereTagNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereTechnicalSpecification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereVendorsInstructionManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantRegistration withoutTrashed()
 */
	class PlantRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductionPlaningItem
 *
 * @property int $id
 * @property int|null $stock_item_id
 * @property int|null $df_id
 * @property int|null $pps_id
 * @property string|null $pps_qty
 * @property string|null $weight
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereDfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem wherePpsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem wherePpsQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlaningItem whereWeight($value)
 */
	class ProductionPlaningItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductionPlanning
 *
 * @property int $id
 * @property string|null $pps_no
 * @property string|null $pps_date
 * @property int|null $plant
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning wherePlant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning wherePpsDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning wherePpsNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionPlanning whereUpdatedAt($value)
 */
	class ProductionPlanning extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseOrder
 *
 * @property int $id
 * @property string|null $po_number
 * @property string|null $supplier_id
 * @property string|null $pr_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $po_date
 * @property string|null $delivery_date
 * @property int|null $customer_id
 * @property int|null $po_type
 * @property string|null $weight_per_unit
 * @property string|null $volume_per_unit
 * @property string|null $total_weight
 * @property string|null $total_volume
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder wherePoDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder wherePoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder wherePoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder wherePrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereTotalVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereTotalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereVolumePerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereWeightPerUnit($value)
 */
	class PurchaseOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseOrderItem
 *
 * @property int $id
 * @property int|null $item_id
 * @property int|null $po_id
 * @property string|null $po_qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem wherePoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem wherePoQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereUpdatedAt($value)
 */
	class PurchaseOrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchasingRequest
 *
 * @property int $id
 * @property string|null $prf_date
 * @property string|null $prf_no
 * @property int|null $employee_id
 * @property int|null $created_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest wherePrfDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest wherePrfNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequest whereUpdatedAt($value)
 */
	class PurchasingRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchasingRequestItem
 *
 * @property int $id
 * @property int $pr_id
 * @property int $stock_item_id
 * @property string $priority
 * @property int $prf_qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StockItem|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem wherePrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem wherePrfQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem whereStockItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasingRequestItem whereUpdatedAt($value)
 */
	class PurchasingRequestItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RawMaterialSerialCode
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $grn_id
 * @property int|null $grn_item_id
 * @property string|null $serial_no
 * @property string|null $qty
 * @property string|null $supplier_code
 * @property string|null $warehouse_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereGrnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereGrnItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereSerialNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereSupplierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialSerialCode whereWarehouseCode($value)
 */
	class RawMaterialSerialCode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $section_number
 * @property string $department_number
 * @property string|null $section_name
 * @property string|null $section_description
 * @property string|null $remark
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $section_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDepartmentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section withoutTrashed()
 */
	class Section extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StockLocationChange
 *
 * @property int $id
 * @property string $ref_number
 * @property string $slc_date
 * @property string $slc_number
 * @property int $delivered_by
 * @property string $delivered_date
 * @property int $fleet_id
 * @property string|null $remarks
 * @property int|null $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $Customer
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereDeliveredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereDeliveredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereFleetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereSlcDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereSlcNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChange whereUpdatedAt($value)
 */
	class StockLocationChange extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StockLocationChangeIssued
 *
 * @property int $id
 * @property string $slc_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $iss_qty
 * @property int|null $location_id
 * @property int|null $issued_by
 * @property string|null $iss_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereIssDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereIssQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereIssuedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereSlcNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeIssued whereUpdatedAt($value)
 */
	class StockLocationChangeIssued extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StockLocationChangeReceived
 *
 * @property int $id
 * @property string $slc_number
 * @property int $item_id
 * @property string $stock_no
 * @property string $description
 * @property string $uom
 * @property string $revd_qty
 * @property int $location_id
 * @property int $received_by
 * @property string $rec_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Warehouse|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereRecDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereReceivedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereRevdQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereSlcNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereStockNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockLocationChangeReceived whereUpdatedAt($value)
 */
	class StockLocationChangeReceived extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StockItem
 *
 * @property int $id
 * @property string $stock_number
 * @property string|null $description
 * @property string|null $unit
 * @property string|null $cost_price
 * @property string|null $barcode
 * @property string|null $keyword
 * @property string|null $group
 * @property string|null $class
 * @property string|null $serial_number
 * @property string|null $part_number
 * @property string|null $model
 * @property string|null $make
 * @property string|null $minimum_qty
 * @property string|null $maximum_qty
 * @property string|null $re_order_level
 * @property string|null $substitute_stock_number
 * @property int|null $enduser
 * @property int|null $created_by
 * @property int|null $verified_by
 * @property int|null $approved_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stock_item_Grade
 * @property string|null $stock_item_chem_c
 * @property string|null $stock_item_chem_mn
 * @property string|null $stock_item_mech_ys
 * @property string|null $stock_item_mech_ts
 * @property string|null $stock_item_mech_ei
 * @property string|null $stock_item_physical_weight
 * @property string|null $stock_item_physical_width
 * @property string|null $stock_item_physical_thickness
 * @property string|null $stock_item_date_of_mfr
 * @property string|null $stock_item_date_of_expiry
 * @property string|null $stock_item_special_ins
 * @property string|null $stock_item_storage_method
 * @property string|null $stock_item_handling_method
 * @property int $stock_item_inspection_reuired
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $StockItem_status
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereEnduser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereMaximumQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereMinimumQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem wherePartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereReOrderLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemChemC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemChemMn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemDateOfExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemDateOfMfr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemHandlingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemInspectionReuired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemMechEi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemMechTs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemMechYs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemPhysicalThickness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemPhysicalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemPhysicalWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemSpecialIns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockItemStorageMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereStockitemMainStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereSubstituteStockNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem whereVerifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockItem withoutTrashed()
 */
	class StockItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $supplier_code
 * @property string|null $supplier_name
 * @property string|null $business_registration_number
 * @property int|null $business_registration_image
 * @property int $supplier_registration_type
 * @property string|null $supplier_vat_number
 * @property string|null $supplier_product_type
 * @property string|null $supplier_address_line1
 * @property string|null $supplier_address_line2
 * @property string|null $supplier_web_address
 * @property string|null $supplier_mobile_number
 * @property string|null $supplier_svat_number
 * @property string|null $supplier_fixedphone_number
 * @property string|null $supplier_email
 * @property int $supplier_type
 * @property int $supplier_status
 * @property string|null $supplier_contact_person_name
 * @property string|null $supplier_contact_person_designation
 * @property string|null $supplier_contact_person_mobile_number
 * @property string|null $supplier_contact_person_email
 * @property string|null $supplier_bank_name
 * @property string|null $supplier_bank_branch
 * @property string|null $supplier_bank_account_number
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @property-read \App\Models\User|null $updateUser
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereBusinessRegistrationImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereBusinessRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierContactPersonDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierContactPersonEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierContactPersonMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierFixedphoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierRegistrationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierSvatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierWebAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier withoutTrashed()
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaxCreation
 *
 * @property int $id
 * @property string $tax_code
 * @property string|null $tax_name
 * @property string|null $tax_rate
 * @property string|null $tax_description
 * @property string|null $start_date
 * @property string|null $expire_date
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $tax_creation_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @property-read \App\Models\User|null $updateUser
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereTaxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereTaxCreationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereTaxDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereTaxName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCreation withoutTrashed()
 */
	class TaxCreation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LocationBayDesign
 *
 * @property int $id
 * @property string $warehouse_code
 * @property string $bay_number
 * @property string|null $bay_description
 * @property string $bay_height
 * @property string $bay_width
 * @property string $bay_length
 * @property string $bay_floor_area
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $locationbaydesign_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $UpdateUser
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesignonlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereBayDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereBayFloorArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereBayHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereBayLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|locationbaydesign whereBayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereBayWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereLocationbaydesignStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationBayDesignwithoutTrashed()
 */
	class LocationBayDesign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\warehouse
 *
 * @property int $id
 * @property string $warehouse_code
 * @property string $warehouse_name
 * @property string|null $description
 * @property string $warehouse_height
 * @property string $warehouse_width
 * @property string $warehouse_length
 * @property string $warehouse_floor_area
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $warehouse_status
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $createUser
 * @property-read \App\Models\User|null $deleteUser
 * @property-read \App\Models\User|null $updateUser
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wwarehouse whereWarehouseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseFloorArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse withoutTrashed()
 */
	class Warehouse extends \Eloquent {}
}

