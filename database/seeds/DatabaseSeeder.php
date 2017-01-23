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
                ['nim' => $data->nim, 'password' => bcrypt('password'),
                 'role' => (in_array ($data->nim, $admin)) ? 'admin' : 'user',
                 'email' => $data->nim . '@std.stei.itb.ac.id']
            );
        }

        if (false)
        for ($i = 1; $i <= 100; $i++) {
            $istring = (string)$i;
            if ($i < 100) {
                $istring = '0' . $istring;
            }
            if ($i < 10) {
                $istring = '0' . $istring;
            }
            $nim = '13512' . $istring;
            User::create(
                ['nim' => $nim, 'password' => bcrypt('password'), 'role' => 'user']
            );
        }
    }
}
