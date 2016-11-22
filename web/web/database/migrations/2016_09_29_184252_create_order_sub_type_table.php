<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSubTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('order_sub_type')) {
            Schema::create('order_sub_type', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order_type_id');
                $table->string('name', 20);
                $table->double('price', 8, 2);
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB';
                $table->foreign('order_type_id')->references('id')->on('order_type');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
