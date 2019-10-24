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

    // Menghitung total item
    public function getTotalQuantityAttribute()
    {
        $total_quantity = 0;

        foreach ($this->item as $data)
        {
            $total_quantity += $data->pivot->quantity;
        }

        return $total_quantity;
    }

    // menghitung price
    public function getTotalPriceAttribute()
    {
        $total_price = 0;
        foreach ($this->item as $data) {
            $total_price = $total_price + ($data->price * $data->pivot->quantity);
        }

        return $total_price;
    }
}
