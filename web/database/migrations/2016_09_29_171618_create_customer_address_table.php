<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_address')) {
            Schema::create('customer_address', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('food_type',10);
                $table->string('address_type',20);
                $table->string('address',100);
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB'; 
                $table->foreign('user_id')->references('id')->on('users');
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
