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
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->string('origin');
            $table->string('destiny');
            $table->integer('total_distancy_km');
            $table->string('cargo_type');
            $table->decimal('total_cargo_value', 10, 2);
            $table->integer('traffic_accident_year_history');
            $table->string('route_weather_forecas');
            $table->boolean('has_insurance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
