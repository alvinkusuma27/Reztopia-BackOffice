<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    use HasFactory;

    protected $table = 'order_status';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
