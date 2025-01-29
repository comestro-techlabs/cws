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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedTinyInteger('month'); // Stores month (1 = Jan, 2 = Feb, etc.)
            $table->unsignedSmallInteger('year'); // Stores the payment year
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedTinyInteger('month'); // Stores month (1 = Jan, 2 = Feb, etc.)
            $table->unsignedSmallInteger('year'); // Stores the payment year
        });
    }
};
