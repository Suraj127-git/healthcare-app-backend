<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcDonationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('hc_donation_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('hc_user');
            $table->enum('donation_type', ['Blood', 'Organ', 'Kidney']);
            $table->string('purpose');
            $table->integer('donation_amount');
            $table->date('donation_date');
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->enum('status', ['Pending', 'Completed', 'Failed']);
            $table->bigInteger('created_date');
            $table->bigInteger('created_timestamp');
            $table->bigInteger('updated_timestamp');
            $table->bigInteger('is_show_flag');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_donation_history');
    }
};
