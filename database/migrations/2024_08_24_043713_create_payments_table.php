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
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->foreignId('workshop_id')->nullable()->constrained('workshops')->onDelete('set null');
            $table->string('payment_type')->default('course'); // course, workshop, subscription
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('transaction_fee', 10, 2)->default(0);
            $table->string('currency')->default('INR');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('initiated'); // initiated, pending, completed, failed
            $table->string('status')->default('pending'); // pending, captured, failed
            $table->string('order_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->timestamps();

            // Add indexes for better query performance
            $table->index(['student_id', 'course_id']);
            $table->index(['student_id', 'workshop_id']);
            $table->index(['payment_type', 'status']);
            $table->index(['payment_status', 'created_at']);
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
