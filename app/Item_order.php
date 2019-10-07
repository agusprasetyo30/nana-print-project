<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_order extends Model
{
    protected $table = "item_orders";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function item()
    {
        return $this->belongsToMany('App\Item', 'item_order_detail', 'item_order_id', 'item_id')
            ->withPivot('quantity');
    }
}
