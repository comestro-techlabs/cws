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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User placing the order
            $table->foreignId('shipping_detail_id')->constrained('shipping_details')->onDelete('cascade'); // Shipping details
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Product being redeemed
            $table->string('order_number')->unique(); 
            $table->decimal('total_amount', 10, 2); 
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending'); // Order status
            $table->string('payment_method');
            $table->string('transaction_id')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
