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
        Schema::create('official_stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name', 100);
            $table->string('store_slug', 200)->unique();
            $table->text('store_description')->nullable();
            $table->string('store_image_name', 50)->nullable();
            $table->string('original_store_image_name', 200)->nullable();
            $table->string('store_route_name', 50);
            $table->string('store_redirect_url', 200)->nullable();
            $table->boolean('featured_store');
            $table->string('model_type', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_stores');
    }
};
