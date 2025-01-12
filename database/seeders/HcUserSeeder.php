<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcUser; // Make sure to import the HcUser model
use Faker\Factory as Faker;

class HcUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // Create a Faker instance

        // Loop to create 20 fake users
        for ($i = 0; $i < 20; $i++) {
            HcUser::create([
                'name' => $faker->name,
                'mobile_no' => $faker->unique()->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Default password
                'created_date' => now()->toDateString(),
                'created_timestamp' => now(),
                'updated_timestamp' => now(),
                'is_show_flag' => 1,
                'status' => 1,
            ]);
        }
    }
}