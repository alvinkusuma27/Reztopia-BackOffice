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
        'slug',
        'image',
        'created_at',
        'updated_at'
    ];

    public function outlet()
    {
        return $this->hasMany(Outlet::class, 'id', 'id_outlet');
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
