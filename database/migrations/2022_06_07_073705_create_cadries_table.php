<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadries', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('department_id')->nullable();
            $table->integer('fullname');
            $table->string('phone');
            $table->date('date_med1')->nullable();
            $table->date('date_med2')->nullable();
            $table->date('date_vac1')->nullable();
            $table->date('date_vac2')->nullable();
            $table->date('date_tb1')->nullable();
            $table->date('date_tb2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadries');
    }
}
