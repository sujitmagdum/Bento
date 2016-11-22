<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_addresses')) {
            Schema::create('customer_addresses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->string('address_type',10);
                $table->string('address',100);
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB'; 
                $table->foreign('cust_id')->references('id')->on('customer');
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
