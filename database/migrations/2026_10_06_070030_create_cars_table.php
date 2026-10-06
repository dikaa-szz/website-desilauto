<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('model');
            $table->string('variant')->nullable();
            $table->unsignedSmallInteger('year');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('mileage')->nullable();
            $table->string('transmission', 20);
            $table->string('fuel_type', 20);
            $table->string('body_type', 30)->nullable();
            $table->string('color', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 20)->default('available');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_published', 'status']);
            $table->index('year');
            $table->index('price');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};