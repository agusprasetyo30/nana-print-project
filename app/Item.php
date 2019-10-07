<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'item_category', 'item_id', 'category_id');
        // return $this->belongsToMany('App\Category');
    }

    public function item_order()
    {
        return $this->belongsToMany('App\Item_order', 'item_order_detail', 'item_id', 'item_order_id');
    }
    
}
