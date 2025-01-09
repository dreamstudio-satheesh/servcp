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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id'); // Reference to `sales`
            $table->unsignedBigInteger('item_id'); // Reference to `store_items`
            $table->integer('quantity'); // Quantity sold
            $table->decimal('selling_price', 10, 2); // Selling price per unit
            $table->decimal('tax', 10, 2)->default(0.00); // Tax on the item
            $table->decimal('total', 10, 2); // Total amount (quantity * price + tax)
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('store_items')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
