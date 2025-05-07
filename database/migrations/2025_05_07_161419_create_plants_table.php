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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->string('family')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('planting_method', ['tanah', 'pot', 'hidroponik'])->default('tanah');
            $table->float('carbon_absorption_rate')->nullable();
            $table->float('temp_reduction_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
