<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Таблица правил должность->авто
     */
    public function up(): void
    {
        Schema::create('rule_use_cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('position_id')->constrained();
            $table->foreignId('car_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_use_car');
    }
};
