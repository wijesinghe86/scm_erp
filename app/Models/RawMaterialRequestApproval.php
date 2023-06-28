<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialRequestApproval extends Model
{
    use HasFactory;

    public function raw_material_request()
    {
        return $this->hasOne(RawMaterialRequest::class, 'id', 'rmr_no');
    }

    public function raw_material_request_item()
    {
        return $this->hasOne(RawMaterialRequestItem::class, 'id', 'rmr_item_id');
    }
}
