<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note_cart extends Model
{
    use HasFactory;

    protected $table = 'note_cart';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'note',
        'created_at',
        'updated_at',
    ];

    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class);
    // }
}
