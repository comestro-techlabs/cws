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
        Schema::create('mock_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mock_test_id')->constrained()->onDelete('cascade');
            $table->json('answers');
            $table->unsignedInteger('score');
            $table->integer('total_questions');
            $table->timestamp('completed_at')->nullable();
            $table->unique(['user_id', 'mock_test_id'], 'user_mock_test_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mock_test_results');
    }
};
