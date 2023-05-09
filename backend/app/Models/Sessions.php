<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_user',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }
}
