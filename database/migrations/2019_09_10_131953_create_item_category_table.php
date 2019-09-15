<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')
                ->on('items');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_category', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['category_id']);
        });
        
        Schema::dropIfExists('item_category');
    }
}
