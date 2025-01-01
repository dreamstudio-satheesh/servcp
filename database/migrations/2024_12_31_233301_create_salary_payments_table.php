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
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Payment date
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade'); // Reference to staff
            $table->decimal('amount', 15, 2); // Salary payment amount
            $table->text('description')->nullable(); // Additional description
            $table->enum('payment_type', ['Cash', 'Cheque', 'Digital', 'Balance'])->default('Cash'); // Payment type
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_payments');
    }
};
