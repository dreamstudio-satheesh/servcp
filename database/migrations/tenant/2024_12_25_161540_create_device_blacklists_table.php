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
        Schema::create('device_blacklists', function (Blueprint $table) {
            $table->id();
            $table->date('blacklisted_date');
            $table->string('imei');
            $table->foreignId('company_id')->constrained('device_companies')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('device_models')->onDelete('cascade');
            $table->string('contact_person')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_blacklists');
    }
};
