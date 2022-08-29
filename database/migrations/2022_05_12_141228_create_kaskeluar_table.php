<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaskeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaskeluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('bukti')->nullable();
            $table->bigInteger('jumlah');
            $table->string('deskripsi', 100)->nullable();
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
        Schema::dropIfExists('kaskeluar');
    }
}
