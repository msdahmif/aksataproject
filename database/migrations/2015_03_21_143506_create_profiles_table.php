<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
            // required fields
            $table->increments('id');
            $table->string('user_nim');
            $table->integer('angkatan');
            $table->string('nama_lengkap', 128);
            $table->string('nama_panggilan', 64);
            $table->string('tempat_lahir', 128);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);

            $table->string('email');
            $table->text('telepon');

            $table->text('alamat_asal')->nullable();
            $table->text('alamat_bandung')->nullable();

            $table->string('wali', 128)->nullable();
            $table->string('foto_url', 128)->nullable();

            $table->enum('keanggotaan', ['Muda', 'Biasa', 'Kehormatan', 'Other']);

            $table->string('nim_tpb', 8)->nullable();
            $table->text('media_sosial')->nullable();

            // the access rights for each of the fields
            $table->text('hak_lihat');

            // created_at and updated_at fields
            $table->timestamps();
        });

        Schema::table('profiles', function(Blueprint $table){
            // foreign key to the members table
            $table->foreign('user_nim')->references('nim')->on('users');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}
