<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade'); // Reference to accounts
            $table->date('date');                    // Transaction date
            $table->text('description')->nullable(); // Description of the transaction
            $table->decimal('debit_amount', 15, 2)->default(0);  // Debit amount
            $table->decimal('credit_amount', 15, 2)->default(0); // Credit amount
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ledgers');
    }
}
