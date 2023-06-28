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
        // 'id_order_detail',
        'id_category',
        'id_user',
        'cashier',
        'link',
        'payment_method',
        'payment_code',
        'table_number',
        'proof_of_payment',
        'date_order',
        'time_order',
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

    public function order_status_pesanan_and_laporan()
    {
        return $this->hasMany(Order_status::class, 'id', 'id_order_status')->where('name', 'sukses');
    }

    public function order_status()
    {
        return $this->hasMany(Order_status::class, 'id', 'id_order_status');
    }

    public function order_detail()
    {
        return $this->hasMany(Order_detail::class, 'id_order', 'id');
    }

    // public function order_detail_pesanan_and_laporan()
    // {
    //     return $this->belongsTo(Order_detail::class);
    // }

    // public function detail()
    // {
    //     return $this->belongsToMany(Order_detail::class, 'orders', 'id_order', 'id');
    // }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function product()
    {
        // return $this->hasManyThrough(Products::class, Order_detail::class);
        return $this->belongsToMany(Products::class, 'order_details', 'id_product', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Categories::class, 'id', 'id_categories');
    }
}
