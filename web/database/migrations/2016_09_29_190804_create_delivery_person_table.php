<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('delivery_person')) {
            Schema::create('delivery_person', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cust_id');
                $table->string('kyc_type',10);
                $table->string('kyc_proof',250);
                $table->timestamp('last_logged_in')->nullable();
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
