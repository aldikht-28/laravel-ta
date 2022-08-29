<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSumberkeluarToKaskeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kaskeluar', function (Blueprint $table) {
            $table->foreignId('id_sumberkeluar')->after('id')->references('id')
                ->on('sumberkeluar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kaskeluar', function (Blueprint $table) {
            $table->dropColumn('id_sumberkeluar');
        });
    }
}
