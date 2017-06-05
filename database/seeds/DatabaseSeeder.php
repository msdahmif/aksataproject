<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Profile;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
    }

}

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        // import from profiles
        $dataang = DB::select('select * from profiles');

        // make us admin huahaha
        $admin = ['13512076', '13515071', '13514088'];

        foreach ($dataang as $data)
        {
            User::create(
                ['nim' => $data->user_nim, 'password' => bcrypt('password'),
                 'role' => (in_array ($data->user_nim, $admin)) ? 'admin' : 'user',
                 'email' => $data->user_nim . '@std.stei.itb.ac.id']
            );
        }
    }
}
