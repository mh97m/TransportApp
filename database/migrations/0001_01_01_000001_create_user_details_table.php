<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->timestamps();
        });
        Schema::create('loader_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('car_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('driver_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_type_id')->constrained('car_types')->onDelete('cascade');
            $table->foreignId('loader_type_id')->constrained('loader_types')->onDelete('cascade');
            $table->string('plaque');
            $table->string('license');
            $table->timestamps();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('call_counts');
            $table->integer('price');
            $table->dateTime('expire_at')->nullable();
            $table->timestamps();
        });
        Schema::create('owner_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_details');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('driver_details');
        Schema::dropIfExists('loader_types');
        Schema::dropIfExists('car_types');
    }
};
