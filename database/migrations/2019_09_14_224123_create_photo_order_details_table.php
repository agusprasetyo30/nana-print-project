<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('print_order_id')
                ->unsigned();
            $table->bigInteger('paper_id')
                ->unsigned();
            
            $table->integer('quantity')
                ->unsigned()->default(0);        

            // menghitung total ( quantity * price(paper) )        
            $table->integer('total_quantity_price')
                ->unsigned()->default(0);            
            
            $table->timestamps();

            $table->foreign('print_order_id')
                ->references('id')->on('print_orders');
            
            $table->foreign('paper_id')
                ->references('id')->on('paper_types');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_order_details', function (Blueprint $table) {
            $table->dropForeign(
                [
                    'print_order_id', 
                    'paper_id'
                ]
            );
        });

        Schema::dropIfExists('print_order_details');
    }
}
