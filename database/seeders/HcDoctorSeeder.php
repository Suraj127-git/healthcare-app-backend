<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcDoctor;
use Faker\Factory as Faker;

class HcDoctorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            HcDoctor::create([
                'name' => $faker->name,
                'speciality' => $faker->word,
                'qualification' => $faker->word,
                'experiance' => $faker->numberBetween(1, 30),
                'availability_status' => $faker->randomElement(['Available', 'Unavailable']),
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'clinic_address' => $faker->address,
                'created_date' => now()->toDateString(),
                'created_timestamp' => now(),
                'updated_timestamp' => now(),
                'is_show_flag' => 1,
            ]);
        }
    }
}