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
        Schema::create('sales_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Reference to `sales_orders`
            $table->unsignedBigInteger('item_id'); // Reference to `store_items`
            $table->integer('quantity'); // Quantity ordered
            $table->decimal('price', 10, 2); // Price per unit
            $table->decimal('tax', 10, 2)->default(0.00); // Tax applied
            $table->decimal('total', 10, 2); // Total amount
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('sales_orders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('store_items')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_items');
    }
};
