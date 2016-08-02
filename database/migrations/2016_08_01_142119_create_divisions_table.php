<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nama', 20);
            $table->string('nim_ketua', 8);
            $table->integer('id_kepengurusan')->unsigned();
            $table->integer('id_super')->unsigned()->nullable();
            $table->timestamps();

            // foreign key to the members table (ketua)
            $table->foreign('nim_ketua')->references('nim')->on('profiles')->onDelete('cascade');

            // foreign key to the management table
            $table->foreign('id_kepengurusan')->references('id')->on('managements')->onDelete('cascade');

            // foreign key to the division table (super)
            $table->foreign('id_super')->references('id')->on('divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('divisions');
    }
}
