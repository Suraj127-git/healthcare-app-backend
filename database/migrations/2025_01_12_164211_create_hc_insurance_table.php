<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('hc_insurance', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('hc_user');
            $table->string('insurance_type');
            $table->string('policy_name');
            $table->string('policy_number');
            $table->string('insurance_company');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal ('premium_amount');
            $table->decimal('coverage_amount');
            $table->enum('status', ["active", "inactive", "expired", "cancelled"]);
            $table->date('created_date');
            $table->dateTime('created_timestamp');
            $table->dateTime('updated_timestamp');
            $table->index('user_id');
            $table->index(['user_id', 'status']);
            $table->index('policy_number');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_insurance');
    }
};
