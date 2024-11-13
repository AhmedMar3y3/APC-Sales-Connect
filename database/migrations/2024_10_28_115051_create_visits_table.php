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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_id')->references('id')->on('users');
            $table->foreignId('doctor_id')->nullable()->references('id')->on('doctors');
            $table->foreignId('pharmacy_id')->nullable()->references('id')->on('pharmacies');
            $table->foreignId('medication_id')->references('id')->on('medications');
            $table->date('date');
            $table->time('time');
            $table->text('notes')->nullable();
            $table->boolean('is_sold')->default(false);
            $table->enum('status', ['قيد الأنتظار', 'جارية', 'أكتملت'])->default('قيد الأنتظار');
            $table->integer('points')->default(0);
            $table->unsignedTinyInteger('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
