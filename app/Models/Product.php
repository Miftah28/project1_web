<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'mitra_id',
        'user_id',
        'sku',
        'name',
        'slug',
        'short_description',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function mitra()
    {
        return $this->belongsTo('App\Models\Mitra');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_categories');
    }

    // public function mitras()
    // {
    //     return $this->belongsToMany('App\Models\Mitra', 'product_mitras');
    // }

    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }
}
