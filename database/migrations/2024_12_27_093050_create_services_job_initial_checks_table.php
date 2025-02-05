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
        Schema::create('services_job_initial_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_job_id')->constrained('service_jobs')->onDelete('cascade');
            $table->enum('display_status', ['Working', 'Not Working', 'Not Checked'])->default('Not Checked');
            $table->enum('back_panel_status', ['Working', 'Not Working', 'Not Checked'])->default('Not Checked');
            $table->enum('device_status', ['Working', 'Not Working', 'Not Checked'])->default('Not Checked');
            $table->timestamps();
        
            $table->index(['display_status', 'back_panel_status', 'device_status'], 'sj_initial_checks_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_job_initial_checks');
    }
};
