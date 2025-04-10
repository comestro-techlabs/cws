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
        Schema::create('post_my_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_topic_post_id')->constrained('post_topic_posts')->onDelete('cascade');
            $table->string('title');
            $table->longText('content');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_my_posts');
    }
};
