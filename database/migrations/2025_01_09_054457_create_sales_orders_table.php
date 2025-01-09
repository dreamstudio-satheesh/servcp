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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique(); // Unique order number
            $table->unsignedBigInteger('customer_id'); // Reference to `service_customers`
            $table->date('order_date')->default(now()); // Order date
            $table->text('remarks')->nullable(); // Optional remarks
            $table->decimal('total_amount', 10, 2)->default(0.00); // Total before discount and tax
            $table->decimal('discount', 10, 2)->default(0.00); // Discount applied
            $table->decimal('tax', 10, 2)->default(0.00); // Tax amount
            $table->decimal('net_amount', 10, 2)->default(0.00); // Final payable amount
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending'); // Order status
            $table->unsignedBigInteger('salesman_id')->nullable(); // Reference to `users`
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('service_customers')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('users')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
