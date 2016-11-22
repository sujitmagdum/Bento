<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoupenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('coupen')) {
            Schema::create('coupen', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',50);
                $table->string('description',200);
                $table->double('price',8,2);
                $table->char('is_active',1)->default('n');
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
