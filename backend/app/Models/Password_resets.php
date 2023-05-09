<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_resets extends Model
{
    use HasFactory;

    protected $table = 'password_reset';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'index',
        'token',
        'ip',
        'country',
        'city',
        'month',
        'year',
        'status'
    ];
}
