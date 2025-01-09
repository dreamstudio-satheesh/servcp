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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique(); // Invoice number
            $table->string('reference_no')->nullable(); // Optional reference number
            $table->unsignedBigInteger('customer_id'); // Reference to `service_customers`
            $table->unsignedBigInteger('salesman_id')->nullable(); // Reference to `users` for sales personnel            
            $table->unsignedBigInteger('sales_order_id')->nullable(); // Reference to `sales_orders`
            $table->date('sale_date')->default(now()); // Sale date
            $table->text('remarks')->nullable(); // Optional remarks
            $table->decimal('total_amount', 10, 2)->default(0.00); // Total before discount and tax
            $table->decimal('discount', 10, 2)->default(0.00); // Discount applied
            $table->decimal('tax', 10, 2)->default(0.00); // Tax amount
            $table->decimal('net_amount', 10, 2)->default(0.00); // Final payable amount
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('service_customers')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sales_order_id')->references('id')->on('sales_orders')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
