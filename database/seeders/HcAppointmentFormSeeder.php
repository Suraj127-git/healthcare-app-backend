<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HcAppointmentForm;
use Faker\Factory as Faker;

class HcAppointmentFormSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            HcAppointmentForm::create([
                'user_id' => $faker->numberBetween(1, 20), // Assuming user IDs are from 1 to 20
                'patient_name' => $faker->name,
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'appointment_date' => $faker->date(),
                'appointment_time' => $faker->time(),
                'department' => $faker->word,
                'doctor' => $faker->numberBetween(1, 20), // Assuming doctor IDs are from 1 to 20
                'notes' => $faker->text,
                'created_date' => now()->toDateString(),
                'created_timestamp' => now(),
                'updated_timestamp' => now(),
            ]);
        }
    }
}