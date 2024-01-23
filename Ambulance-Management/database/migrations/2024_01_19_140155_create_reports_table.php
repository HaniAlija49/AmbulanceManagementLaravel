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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->string('symptoms')->nullable();
            $table->string('diagnoses')->nullable();
            $table->string('prescriptions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
