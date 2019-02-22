<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sensdata_id');
            $table->integer('sensor_id');
            $table->double('sddvalue',9,2);
            $table->double('limitupper',9,2);
            $table->double('limitunder',9,2);
            $table->integer('sendflg');
            $table->datetime('sendingtime');
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
        Schema::dropIfExists('alertques');
    }
}
