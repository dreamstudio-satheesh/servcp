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
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_no')->unique(); // Unique return number
            $table->unsignedBigInteger('sale_id'); // Reference to `sales`
            $table->unsignedBigInteger('customer_id'); // Reference to `service_customers`
            $table->date('return_date')->default(now()); // Return date
            $table->text('remarks')->nullable(); // Optional remarks
            $table->decimal('total_amount', 10, 2)->default(0.00); // Total return amount
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('service_customers')->onDelete('cascade');
        });
        
        Schema::create('sales_return_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_return_id'); // Reference to `sales_returns`
            $table->unsignedBigInteger('item_id'); // Reference to `store_items`
            $table->integer('quantity'); // Quantity returned
            $table->decimal('return_price', 10, 2); // Return price per unit
            $table->decimal('tax', 10, 2)->default(0.00); // Tax on the return
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('sales_return_id')->references('id')->on('sales_returns')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('store_items')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_returns');
        Schema::dropIfExists('sales_return_items');
    }
};
