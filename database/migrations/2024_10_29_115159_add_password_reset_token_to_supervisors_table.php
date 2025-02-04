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
        Schema::table('supervisors', function (Blueprint $table) {
            if (!Schema::hasColumn('supervisors', 'password_reset_token')) {
                $table->text('password_reset_token')->nullable();
            } else {
                $table->text('password_reset_token')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->dropColumn('password_reset_token');
        });
    }
};
