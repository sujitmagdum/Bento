<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('order_timings')) {
            Schema::create('order_timings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order_type_id');
                $table->string('timing',20);
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
    public function down()
    {
        //
    }
}
