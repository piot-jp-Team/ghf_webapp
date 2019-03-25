<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSensdataTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensdatas', function (Blueprint $table) {
            //
            $table->double('ctgain',6,2)->default(1)->after('sdivalue');
            $table->double('ctoffset',6,2)->default(0)->after('ctgain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensdatas', function (Blueprint $table) {
            //
        });
    }
}
