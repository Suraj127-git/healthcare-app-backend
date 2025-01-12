<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcDonationHistory;
use Faker\Factory as Faker;

class HcDonationHistorySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            HcDonationHistory::create([
                'user_id' => $faker->numberBetween(1, 20),
                'donation_type' => $faker->randomElement(['Blood', 'Organ', 'Kidney']),
                'purpose' => $faker->word,
                'donation_amount' => $faker->numberBetween(100, 1000),
                'donation_date' => $faker->date(),
                'payment_method' => $faker->word,
                'transaction_id' => $faker->unique()->word,
                'status' => $faker->randomElement(['Pending', 'Completed', 'Failed']),
                'created_date' => now()->timestamp,
                'created_timestamp' => now()->timestamp,
                'updated_timestamp' => now()->timestamp,
                'is_show_flag' => 1,
            ]);
        }
    }
}