<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('otp')) {
            Schema::create('otp', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('otp',10);
                $table->string('phone_no',20);
                $table->string('status',1);
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
