<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_order_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_order_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->Integer('quantity')
                ->unsigned()->defaults(1);

            $table->timestamps();

            $table->foreign('item_order_id')->references('id')
                ->on('item_orders');

            $table->foreign('item_id')->references('id')
                ->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_order_detail', function (Blueprint $table) {
            $table->dropForeign(['item_order_id']);
            $table->dropForeign(['item_id']);
        });

        Schema::dropIfExists('item_order_detail');
    }
}
