<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sensoer_id');
            $table->date('sddate');
            $table->time('sdtime');
            $table->datetime('sddatetime');
            $table->double('sddvalue',9,2);
            $table->integer('sdivalue');
            $table->string('sdflug',3);
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
        Schema::dropIfExists('sensdatas');
    }
}
