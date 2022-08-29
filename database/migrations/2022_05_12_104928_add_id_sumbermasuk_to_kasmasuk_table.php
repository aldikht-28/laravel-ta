<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSumbermasukToKasmasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kasmasuk', function (Blueprint $table) {
            $table->foreignId('id_sumbermasuk')
                ->after('id')->references('id')
                ->on('sumbermasuk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kasmasuk', function (Blueprint $table) {
            $table->dropColumn('id_sumbermasuk');
        });
    }
}
