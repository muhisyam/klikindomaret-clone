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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')
                ->nullable()
                ->default(1) // default user
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('fullname', 200);
            $table->string('username', 100)->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->date('birthdate');
            $table->string('mobile_number')->unique();
            $table->timestamp('mobile_number_verified_at');
            $table->string('user_image_name')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
