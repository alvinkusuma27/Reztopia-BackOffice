<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ip extends Model
{
    use HasFactory;

    protected $table = 'ip';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'ip',
        'country',
        'city',
        'month',
        'year',
    ];
}
