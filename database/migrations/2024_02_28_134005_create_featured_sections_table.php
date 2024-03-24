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
        Schema::create('featured_sections', function (Blueprint $table) {
            $table->id();
            $table->string('featured_name', 100);
            $table->string('featured_slug', 200)->unique();
            $table->string('featured_redirect_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_sections');
    }
};
