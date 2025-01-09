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
        
        Schema::create('store_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique(); // Unique item code
            $table->string('barcode')->unique(); // Barcode
            $table->unsignedBigInteger('category_id'); // Reference to `store_item_categories`
            $table->unsignedBigInteger('unit_id'); // Reference to `units`
            $table->unsignedBigInteger('tax_id')->nullable(); // Reference to `store_taxes`
            $table->string('item_name'); // Item name
            $table->string('bin_and_rack')->nullable(); // Bin & Rack info
            $table->integer('quantity')->default(0); // Quantity in stock
            $table->decimal('unit_purchase_cost', 10, 2)->default(0.00); // Purchase cost
            $table->decimal('unit_selling_price', 10, 2)->default(0.00); // Selling price
            $table->boolean('tax_applicable')->default(false); // Tax applicable flag
            $table->boolean('disabled')->default(false); // Active/inactive status
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('store_item_categories')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('store_taxes')->onDelete('set null');
        });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_items');
    }
};
