<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->string('address', 300);
            $table->string('description', 300);
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('payment_type', 16)->default('Wallet');
            $table->integer('total');
            $table->string('status', 25)->default('Yet to be delivered');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
