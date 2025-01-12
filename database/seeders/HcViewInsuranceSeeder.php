<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcViewInsurance;
use Faker\Factory as Faker;

class HcViewInsuranceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            HcViewInsurance::create([
                'user_id' => $faker->numberBetween(1, 20),
                'insurance_count' => $faker->numberBetween(1, 5),
                'active_policies' => $faker->numberBetween(1, 5),
                'total_premium' => $faker->randomFloat(2, 100, 1000),
                'total_coverage' => $faker->randomFloat(2, 1000, 10000),
                'updated_timestamp' => now(),
                'is_show_flag' => 1,
            ]);
        }
    }
}