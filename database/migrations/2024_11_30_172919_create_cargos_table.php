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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');

            $table->foreignId('origin_province_id')->on('provinces');
            $table->foreignId('origin_city_id')->on('cities');

            $table->foreignId('destination_province_id')->on('cities');
            $table->foreignId('destination_city_id')->on('provinces');

            $table->foreignId('car_type_id')->on('car_types');
            $table->foreignId('loader_type_id')->on('loader_types');

            $table->foreignId('cargo_type_id')->on('cargo_types');

            $table->string('weight');

            $table->unsignedInteger('price');

            $table->text('desc');

            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
