<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcInsurance;
use Faker\Factory as Faker;

class HcInsuranceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            HcInsurance::create([
                'user_id' => $faker->numberBetween(1, 20),
                'insurance_type' => $faker->word,
                'policy_name' => $faker->word,
                'policy_number' => $faker->unique()->word,
                'insurance_company' => $faker->company,
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'premium_amount' => $faker->randomFloat(2, 100, 1000),
                'coverage_amount' => $faker->randomFloat(2, 1000, 10000),
                'status' => $faker->randomElement(['active', 'inactive', 'expired', 'cancelled']),
                'created_date' => now()->toDateString(),
                'created_timestamp' => now(),
                'updated_timestamp' => now(),
            ]);
        }
    }
}