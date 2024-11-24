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
        Schema::table('user_reports', function (Blueprint $table) {
            $table->foreignId('ac_unit_id')->constrained()->onDelete('cascade');
            $table->enum('result', ['accepted', 'reject', 'pending'])->default('pending');  
            $table->text('rejection_notes')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
