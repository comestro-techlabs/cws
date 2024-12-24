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
        Schema::create('assignment_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('assignment_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('file_path');  
            $table->timestamp('submitted_at')->nullable();  
            $table->enum('status', ['submitted', 'graded', 'pending'])->default('pending'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_uploads');
    }
};
