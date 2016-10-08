<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_balance')) {
            Schema::create('customer_balance', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->decimal('balance',8,2);
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
