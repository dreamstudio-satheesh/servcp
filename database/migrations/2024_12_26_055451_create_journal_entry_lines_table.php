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
        Schema::create('journal_entry_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->onDelete('cascade'); // Reference to journal entry
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade'); // Reference to account
            $table->decimal('debit_amount', 15, 2)->default(0); // Debit amount
            $table->decimal('credit_amount', 15, 2)->default(0); // Credit amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entry_lines');
    }
};
