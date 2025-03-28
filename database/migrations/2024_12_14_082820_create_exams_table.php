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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'course_id')->constrained()->onDelete('cascade');
            $table->foreignId(column: 'batch_id')->constrained()->onDelete('cascade');
            $table->string('exam_name');
            $table->boolean('status')->default(false);
            $table->date('exam_date')->nullable();
            $table->string('passcode')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
