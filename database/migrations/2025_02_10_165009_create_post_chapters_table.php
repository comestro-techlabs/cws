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
        Schema::create('post_chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_course_id')->constrained()->onDelete('cascade');
            $table->string('chapter_name');
            $table->text('chapter_description')->nullable();
            $table->string('chapter_slug')->unique();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_chapters');
    }
};
