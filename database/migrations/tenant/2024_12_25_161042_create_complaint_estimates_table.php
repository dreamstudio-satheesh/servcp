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
        Schema::create('complaint_estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_complaint_id')->constrained('service_complaints')->onDelete('cascade');
            $table->decimal('estimate_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_estimates');
    }
};
