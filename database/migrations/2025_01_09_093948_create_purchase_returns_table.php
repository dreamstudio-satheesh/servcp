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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_no')->unique(); // Unique return number
            $table->unsignedBigInteger('purchase_id'); // Reference to `purchases`
            $table->unsignedBigInteger('vendor_id'); // Reference to `vendors`
            $table->date('return_date')->default(now()); // Return date
            $table->text('remarks')->nullable(); // Optional remarks
            $table->decimal('total_amount', 10, 2)->default(0.00); // Total return amount
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
        
        Schema::create('purchase_return_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_return_id'); // Reference to `purchase_returns`
            $table->unsignedBigInteger('item_id'); // Reference to `store_items`
            $table->integer('quantity'); // Quantity returned
            $table->decimal('return_cost', 10, 2); // Return cost per unit
            $table->decimal('tax', 10, 2)->default(0.00); // Tax on the return
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('purchase_return_id')->references('id')->on('purchase_returns')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('store_items')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
        Schema::dropIfExists('purchase_return_items');
    }
};
