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

		$this->call('ProfileTableSeeder');
        $this->call('UserTableSeeder');
	}

}

class ProfileTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('profiles')->delete();

        // import from data_ang
        $dataang = DB::select('select * from data_ang');

//        dd($dataang);

        foreach($dataang as $data)
        {
            Profile::create([
                'nim' => $data->nim,
                'angkatan' => $data->angkatan,
                'nama_lengkap' => $data->nama_lengkap,
                'nama_panggilan' => $data->nama_panggilan,
                'foto_url' => 'assets/images/anonim.png',
                'jenis_kelamin' => 'laki-laki',
                'telepon' => json_encode([
                    [
                        'label' => 'Primary',
                        'value' => $data->no_hp
                    ]
                ]),
                'email' => json_encode([
                    [
                        'label' => 'Primary',
                        'value' => $data->email
                    ]
                ]),
                'alamat_asal' => json_encode([
                    'jalan' => $data->alamat_asal,
                    'kota' => "kota",
                    'provinsi' => "provinsi",
                    'kodepos' => "kodepos",
                    'geolocation' => "(0, 0)"
                ]),
                'alamat_bandung' => json_encode([
                    'jalan' => $data->alamat_bandung,
                    'kota' => "kota",
                    'provinsi' => "provinsi",
                    'kodepos' => "kodepos",
                    'geolocation' => "(0, 0)"
                ]),
                'tempat_lahir' => $data->tempat_lahir,
                'tanggal_lahir' => $data->tanggal_lahir,
                'golongan_darah' => 'O',
                'penyakit' => 'Tidak Ada',

                'mbti' => 'MBTI',
                'nim_tpb' => $data->nim_tpb,
                'media_sosial' => json_encode([
                    [
                        'label' => 'Facebook',
                        'value' => 'http://facebook.com/' . $data->facebook
                    ]
                ]),

                'catatan_msda' => 'Halo!',

                'hak_lihat' => json_encode([
                    'jenis_kelamin' => 'public',
                    'telepon' => json_encode([
                        'group'
                    ]),
                    'email' => json_encode([
                        'group',
                    ]),
                    'alamat_asal' => 'group',
                    'alamat_bandung' => 'group',
                    'tempat_lahir' => 'group',
                    'tanggal_lahir' => 'group',
                    'golongan_darah' => 'private',
                    'penyakit' => 'private',

                    'mbti' => 'private',
                    'nim_tpb' => 'group',
                    'media_sosial' => json_encode([
                        'group'
                    ])
                ])
            ]);
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


			Profile::create([
                'nim' => $nim,
                'nama_lengkap' => 'Nama Lengkap',
                'nama_panggilan' => 'Nama Panggilan',
                'foto_url' => 'assets/images/anonim.png',
                'jenis_kelamin' => 'laki-laki',
                'telepon' => json_encode([
                    [
                        'label' => 'Primary',
                        'nomor' => '08170009891'
                    ]
                ]),
                'email' => json_encode([
                    [
                        'label' => 'Primary',
                        'nomor' => 'ahmadzaky003@gmail.com'
                    ],
                    [
                        'label' => 'STD',
                        'nomor' => '13512076@std.stei.itb.ac.id'
                    ]
                ]),
                'alamat_rumah' => json_encode([
                    'jalan' => "Jl. Al-Washliyah no. 19 RT 003/04, kel. Jati, kec. Pulogadung",
                    'kota' => "Jakarta Timur",
                    'provinsi' => "DKI Jakarta",
                    'kodepos' => "13220",
                    'latitude' => "0",
                    'langitude' => "0"
                ]),
                'alamat_bandung' => json_encode([
                    'jalan' => "Jl. Cisitu Lama gg. III no. 24a/154c",
                    'kota' => "Bandung",
                    'provinsi' => "Jawa Barat",
                    'kodepos' => "40135",
                    'latitude' => "0",
                    'langitude' => "0"
                ]),
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => \Carbon\Carbon::create(1995, 4, 17),
                'golongan_darah' => 'O',
                'penyakit' => 'Tidak ada',

                'mbti' => 'ISTP',
                'nim_tpb' => '16512398',
                'media_sosial' => json_encode([

                ]),

                'catatan_msda' => 'Halo!',

                'hak_lihat' => json_encode([
                    'foto_url' => 'public',
                    'jenis_kelamin' => 'public',
                    'telepon' => json_encode([
                        'group'
                    ]),
                    'email' => json_encode([
                        'group',
                        'public'
                    ]),
                    'alamat_rumah' => 'group',
                    'alamat_bandung' => 'group',
                    'tempat_lahir' => 'group',
                    'tanggal_lahir' => 'group',
                    'golongan_darah' => 'private',
                    'penyakit' => 'private',

                    'mbti' => 'private',
                    'nim_tpb' => 'group',
                    'media_sosial' => json_encode([

                    ])
                ])
            ]);
//
//            // MSDA's notes
//            $table->text('catatan_msda');
//
//            // the access rights for each of the fields
//            $table->json('hak_lihat');
		}
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

        // import from data_ang
        $dataang = DB::select('select * from data_ang');

        foreach ($dataang as $data)
        {
            User::create(
                ['nim' => $data->nim, 'password' => bcrypt('password'), 'role' => 'user']
            );
        }

        // make me an admin huahaha
        $me = User::find('13512076')->first();
        $me->role = 'admin';
        $me->save();

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
