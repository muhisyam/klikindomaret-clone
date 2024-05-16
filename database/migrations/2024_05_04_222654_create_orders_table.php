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
            $table->string('user_order_status', 50);
            $table->string('pickup_info', 15);
            $table->morphs('pickup_address', 'address_type_id_index');
            $table->string('pickup_code', 10)->nullable();
            $table->date('pickup_expired')->nullable();
            $table->string('payment_channel', 30)->nullable();
            $table->string('va_number', 20)->nullable();
            $table->integer('grandtotal');
            $table->dateTime('payment_success')->nullable();
            $table->dateTime('order_completed')->nullable();
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
