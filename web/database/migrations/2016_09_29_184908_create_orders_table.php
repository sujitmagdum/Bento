<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order_details')) {
            Schema::create('order_details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->integer('order_type_id');
                $table->integer('order_sub_type_id');
                $table->string('dishes_id',20);
                $table->date('date');
                $table->integer('order_quantity');
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB';
                $table->foreign('cust_id')->references('id')->on('customer');
                $table->foreign('order_type_id')->references('id')->on('order_type');
                $table->foreign('order_sub_type_id')->references('id')->on('order_sub_type');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
