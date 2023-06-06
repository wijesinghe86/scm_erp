<?php

namespace App\Models;

use App\Models\GoodsReceivedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['stock_number',
        'description',
        'unit',
        'cost_price',
        'barcode',
        'keyword',
        //'group',
        'class',
        'serial_number',
        'part_number',
        'model',
        'make',
        'minimum_qty',
        'maximum_qty',
        're_order_level',
        'substitute_stock_number',
        'enduser',
        'stock_item_Grade',
        'stock_item_chem_c',
        'stock_item_chem_mn',
        'stock_item_mech_ys',
        'stock_item_mech_ts',
        'stock_item_mech_ei',
        'stock_item_physical_weight',
        'stock_item_physical_width',
        'stock_item_physical_thickness',
        'stock_item_date_of_mfr',
        'stock_item_date_of_expiry',
        'stock_item_special_ins',
        'stock_item_storage_method',
        'stock_item_handling_method',
        'stock_item_inspection_reuired',
        'created_by',
        'updated_by',
        'deleted_by'
];

protected $casts = [
    'created_at' => 'datetime:Y-m-d',
];
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
    public function grnItems()
    {
        return $this->hasMany(GoodsReceivedItem::class, 'stock_item_id', 'id');
    }


}
