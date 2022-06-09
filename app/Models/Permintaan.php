<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'requests';
    protected $fillable = [
        'product_id',
        'customer_id',
        'path',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public static function statuses()
    {
        return [
            0 => 'Proses',
            1 => 'Berhasil',
            2 => 'Gagal',
        ];
    }
}
