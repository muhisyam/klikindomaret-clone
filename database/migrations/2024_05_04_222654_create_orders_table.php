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
            $table->string('order_key', 120)->unique();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('user_order_status', 15);
            $table->string('pickup_info', 15);
            $table->string('pickup_code', 10)->nullable();
            $table->date('pickup_expired')->nullable();
            $table->date('expected_pickup_date')->nullable();
            $table->string('expected_time_between', 15)->nullable();
            $table->string('payment_channel', 30)->nullable();
            $table->string('bank_va_number', 20)->nullable();
            $table->integer('grandtotal');
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
