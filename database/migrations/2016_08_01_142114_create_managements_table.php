<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managements', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nama', 20);
            $table->string('nim_ketua', 8);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();

            // foreign key to the members table (ketua)
            $table->foreign('nim_ketua')->references('nim')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('managements');
    }
}
