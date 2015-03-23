<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\User;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->string('nim', 8);
            $table->primary('nim');
            $table->enum('role', User::$roles);
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();

            // foreign key to the members table
            $table->foreign('nim')->references('nim')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
