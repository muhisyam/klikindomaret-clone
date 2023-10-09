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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name', 100);
            $table->string('slug', 200)->unique();
            $table->integer('normal_price');
            $table->integer('discount_price')->nullable();
            $table->longText('description');
            $table->integer('plu');
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('stock');
            // !ARRAY IMAGE EXPECTED
            $table->string('image', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
