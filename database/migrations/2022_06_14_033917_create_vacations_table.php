<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('user_send_id');
            $table->integer('user_rec_id');
            $table->integer('cadry_id');
            $table->date('per1');
            $table->date('per2');
            $table->integer('yosh')->default(0);
            $table->integer('nogiron')->default(0);
            $table->integer('ogirm')->default(0);
            $table->integer('nogfar')->default(0);
            $table->integer('yoshfar')->default(0);
            $table->integer('donor')->default(0);
            $table->integer('other30')->default(0);
            $table->integer('klimat')->default(0);
            $table->integer('tuy')->default(0);
            $table->integer('lastdays')->default(0);
            $table->integer('maindays');
            $table->integer('resultdays');
            $table->integer('lavozim');
            $table->integer('staj');
            $table->date('todate');
            $table->date('fromdate');
            $table->date('date_next');
            $table->boolean('status')->default(false);
            $table->boolean('status_bux')->default(false);
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
        Schema::dropIfExists('vacations');
    }
}
