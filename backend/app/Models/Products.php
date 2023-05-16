<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'original_price',
        'cost_price',
        'discount',
        'cost',
        'price_final',
        'active',
        'image',
        'id_category',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->hasMany(Categories::class, 'id', 'id_category');
    }

    // public function order_detail()
    // {
    //     return $this->belongsTo(Order_detail::class);
    // }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function order_detail()
    {
        return $this->belongsTo(Order_detail::class);
    }
}
