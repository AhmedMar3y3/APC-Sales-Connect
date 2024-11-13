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
        Schema::create('admin_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('status', ['active', 'used'])->default('active');
            $table->unsignedInteger('use_count')->default(0);
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_codes');
    }
};
