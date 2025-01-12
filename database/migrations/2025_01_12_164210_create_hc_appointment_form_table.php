<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcAppointmentFormTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('hc_appointment_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('hc_user');
            $table->string('patient_name');
            $table->string('contact_number');
            $table->string('email');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('department');
            $table->string('doctor');
            $table->foreign('doctor')->references('id')->on('hc_doctors');
            $table->text('notes');
            $table->date('created_date');
            $table->dateTime('created_timestamp');
            $table->dateTime('updated_timestamp');
            $table->index(['appointment_date', 'doctor']);
            $table->index(['contact_number', 'email']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_appointment_form');
    }
};
