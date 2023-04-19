<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'price',
        'discount',
        'add_on_price',
        'varian_on_price',
        'subtotal',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->hasMany(Orders::class, 'id', 'id_order');
    }

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'id_product');
    }
}