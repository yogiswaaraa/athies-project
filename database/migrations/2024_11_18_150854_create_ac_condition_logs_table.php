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
        Schema::create('ac_condition_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_unit_id')->constrained()->onDelete('cascade');
            $table->float('temperature');
            $table->float('humidity')->nullable();
            $table->float('power_consumption')->nullable();
            $table->float('efficiency_rating')->nullable();
            $table->timestamp('logged_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_condition_logs');
    }
};
