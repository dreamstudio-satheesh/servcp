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
        Schema::create('salary_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_payment_id')->constrained('salary_payments')->onDelete('cascade'); // Link to salary payments
            $table->decimal('amount', 15, 2); // Amount for this payment
            $table->string('cheque_no')->nullable(); // Cheque number (if payment is via cheque)
            $table->date('due_date')->nullable(); // Due date for cheque payments
            $table->string('bank_name')->nullable(); // Bank name (if cheque or digital)
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade'); // Account reference (if digital payment)
            $table->text('remarks')->nullable(); // Any additional remarks
            $table->timestamps();
        });
        
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_payment_details');
    }
};
