<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',50);
                $table->string('gender',50);
                $table->string('phone',20);
                $table->string('password',250);
                $table->string('email',250)->nullable();
                $table->string('cust_id',20);
                $table->string('type',20);
                $table->timestamp('last_logged_in')->nullable();
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
