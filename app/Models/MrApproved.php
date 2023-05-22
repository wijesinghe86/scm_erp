<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\StockItem;
use App\Models\MaterialRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrApproved extends Model
{
    use HasFactory;
    public function materialRequest()
    {
        return $this->belongsTo(MaterialRequest::class, 'mr_id', 'id');
    }
    public function item()
    {
        return $this->belongsTo(StockItem::class, 'item_id', 'id');
    }

    public function requested()
    {
        return $this->belongsTo(Employee::class,'requested_employee_id','id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class,'created_user_id','id');
    }

    
}
