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
        Schema::create('maintenance_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_unit_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['maintenance', 'alert', 'performance']);
            $table->string('title');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_notifications');
    }
};
