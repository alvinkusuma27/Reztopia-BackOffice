<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_outlet',
        'id_user',
        'id_product',
        'note',
        'quantity',
        'type_order',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function outlet()
    {
        return $this->hasMany(Outlet::class, 'id', 'id_outlet');
    }

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'id_product');
    }

    // public function note_cart()
    // {
    // return $this->hasMany(note_cart::class, 'id', 'id_note_cart');
    // }
}
