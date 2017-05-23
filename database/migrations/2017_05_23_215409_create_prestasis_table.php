<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->string('title');
            $table->text('deskripsi');
            $table->enum('tingkat', ['ITB', 'Nasional', 'Regional', 'Internasional', 'Other']);
            $table->timestamps();
        });

        Schema::create('keanggotaan_prestasi', function (Blueprint $table){
            $table->increments('id'); //gayakin mau dipake atau nggak
            $table->integer('profile_nim');
            $table->integer('prestasi_id');
            $table->primary(['profile_nim', 'prestasi_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestasis');
    }
}
