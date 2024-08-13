<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Таблица бронирования авто
     */
    public function up(): void
    {
        Schema::create('timings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('car_id')->constrained();
            $table->foreignId('worker_id')->constrained();
            $table->dateTime('start');
            $table->dateTime('end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timings');
    }
};
