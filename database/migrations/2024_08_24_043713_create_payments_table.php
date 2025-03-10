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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('receipt_no')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('transaction_fee')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('payment_card_id')->nullable();
            $table->string('method')->nullable();
            $table->string('wallet')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_vpa')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('international_payment')->nullable();
            $table->string('error_reason')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
