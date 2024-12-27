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
        Schema::create('services_job_physical_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_job_id')->constrained('services_jobs')->onDelete('cascade');
            $table->foreignId('physical_condition_id')->constrained('device_physical_conditions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_job_physical_conditions');
    }
};
