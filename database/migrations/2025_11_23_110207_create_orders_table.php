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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();

            $table->string('address')->nullable();
            $table->text('note')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status')->default('pending')->comment('pending, paid, shipped, completed, canceled');
            $table->string('payment_method')->nullable()->comment('bank_transfer, cash_delivery');
            $table->string('payment_status')->default('pending')->comment('pending, paid, failed, refunded, canceled');
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
