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
            $table->integer('user_nim');
            $table->date('tanggal');
            $table->string('title');
            $table->text('deskripsi');
            $table->enum('tingkat', ['ITB', 'Nasional', 'Regional', 'Internasional', 'Other']);
            $table->timestamps();

            // foreign key to the users table (ketua)
            $table->foreign('user_nim')->references('nim')->on('users')->onDelete('cascade');

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
