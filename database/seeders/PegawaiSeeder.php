<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seeder manual

        // DB::table('data_pegawai')->insert([
        //     'nama' => 'John Doe',
        //     'email' => 'john.doe@example.com',
        //     'departemen' => 'IT',
        //     'umur' => 30,
        //     'jenis_kelamin' => 'Pria',
        //     'tanggal_masuk' => '2020-01-15',
        //     'foto' => null,
        //     'cv' => null,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // seeder otomatis pakai faker

        $faker = Faker::create('en_US');

        for ($i = 1; $i <= 10; $i++){
            $gender = $faker->randomElement(['male', 'female']);
            $nama = $faker->name($gender);
            $nama_email = strtolower(str_replace(' ', '.', $nama));
            $email = $nama_email . '@biis.corp';
            $jenis_kelamin = $gender == 'male' ? 'Pria' : 'Wanita';

            DB::table('data_pegawai')->insert([
                'nama' => $nama,
                'email' => $email,
                'departemen' => $faker->jobTitle(),
                'umur'=> $faker->numberBetween(20,50),
                'jenis_kelamin'=>$jenis_kelamin,
                'tanggal_masuk'=> $faker->date(),
                'foto' => null,
                'cv' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
