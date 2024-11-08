<?php

namespace App\Models;

use App\Models\Warehouse;
use App\Models\InternalIssueItem;
use App\Models\PlantRegistration;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InternalIssue extends Model
{
    use HasFactory;

    public function iid_items()
    {
        return $this->hasMany(InternalIssueItem::class,'iid_id','id');
    }
    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id', 'id');
    }

    public function plant()
    {
        return $this->hasOne(PlantRegistration::class,'id','plant_id');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
}
