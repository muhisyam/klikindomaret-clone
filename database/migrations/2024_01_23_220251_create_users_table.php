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
                ->default(0)
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->date('birthdate');
            $table->string('phone_number')->unique();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->dateTime('last_login');
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
