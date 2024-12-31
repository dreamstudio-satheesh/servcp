<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g., 3001
            $table->string('name');          // Account name
            $table->enum('type', ['Asset', 'Liability', 'Capital', 'Revenue', 'Expense']); // Account type
            $table->foreignId('parent_id')->nullable()->constrained('accounts')->onDelete('cascade'); // Hierarchical relationship
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
