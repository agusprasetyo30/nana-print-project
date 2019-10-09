<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = "papers";

    public function print_order()
    {
        return $this->belongsToMany('App\Item_order', 'item_order_details', 'paper_id', 'print_order_id');
    }
}
