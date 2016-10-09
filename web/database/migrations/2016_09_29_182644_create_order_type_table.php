<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order_type')) {
            Schema::create('order_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',50);
                $table->time('order_start_time');
                $table->time('order_end_time');
                $table->char('is_active',1)->default('y');
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB';
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
