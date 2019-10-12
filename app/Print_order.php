<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Print_order extends Model
{
    protected $table = "print_orders";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function paper()
    {
        return $this->belongsToMany('App\Paper', 'print_order_details', 'print_order_id', 'paper_id')
            ->withPivot('quantity', 'total_quantity_price');
    }

    // Menghitung total paper
    public function getTotalQuantityAttribute()
    {
        $total_quantity = 0;

        foreach ($this->paper as $data)
        {
            $total_quantity += $data->pivot->quantity;
        }

        return $total_quantity;
    }

    // Menghitung total paper
    public function getTotalQuantityPriceAttribute()
    {
        $total_quantity_price = 0;

        foreach ($this->paper as $data)
        {
            $total_quantity_price += $data->pivot->total_quantity_price;
        }

        return $total_quantity_price;
    }


}

