<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PlantRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        // 'stock_number',
    'plant_number',
    'plant_name',
    'plant_type',
    'plant_serial_number',
    'model_number',
    'manufactor_number',
    'capacity',
    'maintenance_period',
    'technical_specification',
    'electricalandelectronical_specification',
    'electronic_specification',
    'manual_operation_specification',
    'maintaining_guide',
    'operation_methods',
    'analytical_manual',
    'vendors_instruction_manual',
    'safety_manual',
    'purchase_date',
    'po_number',
    'grn_number',
    'asset_code',
    'warehouse_code',
    'condition',
    'tag_number',
    'size',
    'weight',
    'output',
    'created_by',
    'updated_by',
    'deleted_by'];

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function UpdateUser()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function deleteUser()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
