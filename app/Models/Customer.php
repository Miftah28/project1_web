<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'telp',
        'address',
        'instansi',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
