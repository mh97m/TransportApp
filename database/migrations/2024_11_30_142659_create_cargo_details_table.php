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
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('loader_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('car_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('cargo_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_types');
        Schema::dropIfExists('loader_types');
        Schema::dropIfExists('cargo_types');
    }
};
