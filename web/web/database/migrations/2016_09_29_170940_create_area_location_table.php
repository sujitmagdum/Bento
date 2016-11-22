<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('area_location')) {
            Schema::create('area_location', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('area_id');
                $table->string('name',50);
                $table->timestamps();
                $table->softDeletes();
                $table->engine = 'InnoDB'; 
                $table->foreign('area_id')->references('id')->on('area');
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
