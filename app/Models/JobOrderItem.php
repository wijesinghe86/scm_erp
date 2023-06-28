<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderItem extends Model
{
    use HasFactory;

    public function job_order()
    {
        return $this->hasOne(JobOrder::class, 'id', 'job_order_id');
    }

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'stock_id');
    }

    public function production_planing()
    {
        return $this->hasOne(ProductionPlanning::class, 'id', 'pps_no');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approval_status_changed_by');
    }
}
