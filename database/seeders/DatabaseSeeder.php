<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
                HcUserSeeder::class,
                HcAppointmentFormSeeder::class,
                HcInsuranceSeeder::class,
                HcViewInsuranceSeeder::class,
                HcDonationHistorySeeder::class,
                HcDoctorSeeder::class,
        ]);
    }
}
