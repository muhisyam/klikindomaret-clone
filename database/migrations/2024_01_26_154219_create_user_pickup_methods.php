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
        Schema::create('user_pickup_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('last_pickup_with_retailer')
                ->nullable()
                ->constrained('retailers')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('last_pickup_with_address')
                ->nullable()
                ->constrained('user_addresses')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->boolean('is_selected_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pickup_methods');
    }
};
