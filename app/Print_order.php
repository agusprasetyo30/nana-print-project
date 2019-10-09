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
        return $this->belongsToMany('App\Paper', 'print_order_details', 'paper_order_id', 'paper_id')
            ->withPivot('quantity', 'total_quantity_price');
    }
}

