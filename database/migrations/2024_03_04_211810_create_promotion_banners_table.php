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
        Schema::create('promotion_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('promotion_banners')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('banner_name', 100);
            $table->string('banner_slug', 200)->unique();
            $table->string('promotion_code', 15)->unique()->nullable();
            $table->smallInteger('promotion_quota')->nullable();
            $table->string('short_term_condition', 100)->nullable();
            $table->text('term_condition')->nullable();
            $table->string('product_image_name', 50)->nullable();
            $table->string('original_product_image_name', 200)->nullable();
            $table->string('deploy_status', 15);
            $table->string('route_name', 50);
            $table->string('redirect_url', 200)->nullable();
            $table->string('redirect_out_site_url', 200)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('model_type', 10);
            $table->text('banner_meta_keyword');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_banners');
    }
};
