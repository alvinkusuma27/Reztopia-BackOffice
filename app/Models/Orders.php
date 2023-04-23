<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_outlet',
        'id_order_status',
        'id_category',
        'id_user',
        'cashier',
        'link',
        'payment_method',
        'customer',
        'total',
        'paid',
        'return',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function outlet()
    {
        return $this->hasMany(Outlet::class, 'id', 'id_outlet');
    }

    public function order_status()
    {
        return $this->hasMany(Order_status::class, 'id', 'id_order_status');
    }

    public function order_detail()
    {
        return $this->belongsTo(Order_detail::class);
    }

    public function categories()
    {
        return $this->hasMany(Categories::class, 'id', 'id_categories');
    }
}
