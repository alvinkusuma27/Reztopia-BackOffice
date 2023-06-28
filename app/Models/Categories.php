<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_outlet',
        'name',
        'description',
        'image',
        'link',
        'created_at',
        'updated_at'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
