<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadryVacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadry_vacs', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('cadry_id');
            $table->date('date1');
            $table->date('date2');
            $table->boolean('status1')->default(false);
            $table->boolean('status2')->default(false);
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
        Schema::dropIfExists('cadry_vacs');
    }
}
