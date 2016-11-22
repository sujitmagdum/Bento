<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoupenPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('coupen_purchase')) {
            Schema::create('coupen_purchase', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->integer('coupen_id');
                $table->char('is_approved',1)->default('n');
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB';
                $table->foreign('cust_id')->references('id')->on('customer');
                $table->foreign('coupen_id')->references('id')->on('coupen');
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
