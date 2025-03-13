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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable()->unique();
            $table->enum("gender",["male","female","other"])->nullable();
            $table->string('education_qualification')->nullable();
            $table->boolean("isAdmin")->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string("password");
            $table->date('dob')->nullable();
            // $table->string('password')->nullable();
            $table->integer('status')->default(0); //0 = new admission, 1 = new student, 2 = old student
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->string('otp')->nullable(); // Column to store OTP
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
