<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

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

        for ($i = 0; $i < $count; $i++) {
            // generate a unique NIM (e.g., 22 + 4 digits)
            do {
                $nim = $faker->numerify('22######');
            } while (in_array($nim, $usedNim));
            $usedNim[] = $nim;

            $nama = $faker->name();
            $email = $faker->unique()->safeEmail();

            Mahasiswa::create([
                'nama' => $nama,
                'nim'  => $nim,
                'email'=> $email,
            ]);
        }
    }
}
