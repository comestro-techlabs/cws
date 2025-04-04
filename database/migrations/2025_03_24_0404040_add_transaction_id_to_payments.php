<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('payment_id');
            $table->string('payment_id')->nullable()->change();
            $table->string('payment_date')->nullable()->change();
            $table->string('payment_status')->default('pending')->change();
            $table->string('status')->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });
    }
};
