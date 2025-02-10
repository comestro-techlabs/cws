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
        Schema::create('post_topic_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_chapter_id')->constrained()->onDelete('cascade');
            $table->string('topic_name');
            $table->integer('order')->default(0)->nullable();
            $table->text('topic_description')->nullable();
            $table->string('topic_slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_topic_posts');
    }
};
