<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('gender', 1);
            $table->string('phone', 20);
            $table->string('password', 250);
            $table->string('cust_id', 20);
            $table->string('type', 20);
            $table->string('email', 250)->nullable();
            $table->string('kyc_type',10)->nullable();
            $table->string('kyc_proof',250)->nullable();
            $table->timestamp('last_logged_in')->nullable();
            $table->string('is_active', 1);
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
