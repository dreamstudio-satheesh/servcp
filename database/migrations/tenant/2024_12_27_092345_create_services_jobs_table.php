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
        Schema::create('services_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_number')->unique();
            $table->foreignId('customer_id')->constrained('service_customers')->onDelete('cascade');
            $table->foreignId('device_company_id')->constrained('device_companies')->onDelete('cascade');
            $table->foreignId('device_model_id')->constrained('device_models')->onDelete('cascade');
            $table->foreignId('device_color_id')->nullable()->constrained('device_colors')->onDelete('set null');
            $table->dateTime('entry_date_time');
            $table->string('reference_number')->nullable();
            $table->enum('warranty_status', ['On Warranty', 'Out of Warranty']);
            $table->string('imei_serial');
            $table->string('device_password');
            $table->string('provider_info')->nullable();
            $table->text('complaint_details');
            $table->text('other_remarks')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_jobs');
    }
};
