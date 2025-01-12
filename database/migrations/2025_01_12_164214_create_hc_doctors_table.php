<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('hc_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('speciality');
            $table->string('qualification');
            $table->integer('experiance');
            $table->enum('availability_status', ['Available', 'Unavailable']);
            $table->string('contact_number');
            $table->string('email');
            $table->string('clinic_address');
            $table->date('created_date');
            $table->dateTime('created_timestamp');
            $table->dateTime('updated_timestamp');
            $table->tinyInteger('is_show_flag');
            $table->index(['name', 'speciality']);
            $table->index(['experiance', 'availability_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_doctors');
    }
};
