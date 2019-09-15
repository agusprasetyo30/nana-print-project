<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndEditItemOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->enum('sending_status', ['KIRIM', 'AMBIL'])->after('total_price');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->dropForeign('item_orders_user_id_foreign');            
            $table->dropColumn('sending_status');
        });
    }
}
