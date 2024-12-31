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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade'); // Reference to accounts table
            $table->date('date'); // Date of receipt
            $table->string('reference')->nullable(); // Reference or receipt number
            $table->text('description')->nullable(); // Receipt description
            $table->decimal('amount', 15, 2); // Receipt amount
            $table->foreignId('entry_staff_id')->constrained('users')->onDelete('cascade'); // Reference to staff
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
