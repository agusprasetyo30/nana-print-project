<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_category', 'category_id', 'item_id');
    }
}