<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateHcUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hc_user', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->integer('mobile_no')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('created_date');
            $table->dateTime('created_timestamp');
            $table->dateTime('updated_timestamp');
            $table->tinyInteger('is_show_flag');
            $table->tinyInteger('status');
            $table->index(['id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_user');
    }
};
