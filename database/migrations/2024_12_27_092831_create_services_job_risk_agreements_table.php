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
        Schema::create('services_job_risk_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_job_id')->constrained('service_jobs')->onDelete('cascade');
            $table->foreignId('risk_agreement_id')->constrained('risk_agreements')->onDelete('cascade');
            $table->timestamps();
        
            $table->unique(['service_job_id', 'risk_agreement_id'],'sj_risk_agreement_id');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_job_risk_agreements');
    }
};
