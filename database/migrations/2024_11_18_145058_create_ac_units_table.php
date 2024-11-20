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
        Schema::create('ac_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->string('unit_code')->unique();
            $table->enum('model', ['ducting', 'split', 'window', 'standing', 'portable', 'smart']);
            $table->string('serial_number');
            $table->enum('status', ['active', 'maintenance', 'inactive']);
            $table->float('current_temperature')->nullable();
            $table->float('efficiency_rating')->nullable();
            $table->date('installation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_units');
    }
};
