<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id', 'path'];

    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
