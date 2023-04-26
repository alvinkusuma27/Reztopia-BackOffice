<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlets';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'id_user',
        // 'id_category',
        'slug',
        'phone',
        'address',
        'image',
        'link',
        'active',
        'created_by',
        'created_at',
        'updated_at'
    ];

    // public function getImageUrlAttribute($value)
    // {
    //     return env('APP_URL') . '/images_ravs/' . $this->image;
    // }

    public function categories()
    {
        return $this->hasMany(Categories::class, 'id', 'id_category');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
