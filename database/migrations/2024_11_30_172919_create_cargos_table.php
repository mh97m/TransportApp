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
        Schema::create('cargo_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->timestamps();
        });
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->ulid();
            $table->string('mobile');

            $table->foreignId('origin_province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('origin_city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('destination_province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('destination_city_id')->constrained('cities')->onDelete('cascade');
            $table->integer('distance');

            $table->foreignId('car_type_id')->constrained('car_types')->onDelete('cascade');
            $table->foreignId('loader_type_id')->constrained('loader_types')->onDelete('cascade');
            $table->foreignId('cargo_type_id')->constrained('cargo_types')->onDelete('cascade');

            $table->unsignedInteger('weight')->nullable();
            $table->unsignedInteger('price');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
        Schema::create('cargo_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('driver_id')->constrained('users');
            $table->timestamps();
        });
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->ulid();
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('driver_id')->constrained('users');
            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->timestamp('changed_at')->nullable();
            $table->boolean('owner_status')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('rater_id')->constrained('users');
            $table->foreignId('ratee_id')->constrained('users');
            $table->unsignedTinyInteger('rating');
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('cargo_types');
    }
};
