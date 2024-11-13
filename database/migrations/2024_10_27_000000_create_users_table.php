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
            $table->foreignId('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['علمي', 'تجاري'])->default('تجاري');
            $table->string('image')->nullable();
            $table->string('verification_code')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->integer(column: 'points')->default(0);
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
