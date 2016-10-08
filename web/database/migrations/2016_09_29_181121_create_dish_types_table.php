<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('dish_types')) {
            Schema::create('dish_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',20);
                $table->string('code',20);
                $table->string('type',20);
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
