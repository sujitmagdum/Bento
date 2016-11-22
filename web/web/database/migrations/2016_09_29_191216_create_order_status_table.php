<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order_status')) {
            Schema::create('order_status', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->integer('order_id');
                $table->string('status',20);
                $table->string('description',200);
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB';
                $table->foreign('cust_id')->references('id')->on('customer');
                $table->foreign('order_id')->references('id')->on('order_details');
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
