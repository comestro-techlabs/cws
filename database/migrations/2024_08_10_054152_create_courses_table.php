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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('course_code')->nullable();
            $table->text('description')->nullable();
            $table->float('duration')->default(0);
            $table->string('instructor')->nullable();
            $table->float('fees')->nullable();
            $table->float('discounted_fees')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('course_image')->nullable();
            $table->boolean('published')->default(false);
            $table->enum('course_type', ['online', 'offline'])->default('offline');
            $table->string('meeting_link')->nullable(); // For Zoom/Google Meet link
            $table->string('meeting_id')->nullable(); // For meeting ID
            $table->string('meeting_password')->nullable(); // For meeting password
            $table->string('venue')->nullable(); // For offline course location

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
