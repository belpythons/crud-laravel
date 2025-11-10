<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $count = 25; // number of dummy records to create
        $usedNim = [];

        // Array of program studi options
        $prodiOptions = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Komputer',
            'Data Science',
            'Cyber Security'
        ];

        for ($i = 0; $i < $count; $i++) {
            // generate a unique NIM (e.g., 22 + 4 digits)
            do {
                $nim = $faker->numerify('22######');
            } while (in_array($nim, $usedNim));
            $usedNim[] = $nim;

            $nama = $faker->name();
            $email = $faker->unique()->safeEmail();
            $prodi = $faker->randomElement($prodiOptions);

            // Use DB facade as fallback if model class loading fails
            DB::table('mahasiswas')->insert([
                'nama' => $nama,
                'nim'  => $nim,
                'email'=> $email,
                'prodi'=> $prodi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
