<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcViewInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('hc_view_insurance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('hc_user');
            $table->integer('insurance_count');
            $table->integer('active_policies');
            $table->decimal('total_premium');
            $table->decimal('total_coverage');
            $table->dateTime('updated_timestamp');
            $table->integer('is_show_flag');
            $table->index('user_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_view_insurance');
    }
};
