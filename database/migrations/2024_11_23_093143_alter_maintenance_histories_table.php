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
        Schema::table('maintenance_histories', function (Blueprint $table) {
        $table->dropForeign(['ac_unit_id']);
        $table->dropColumn('ac_unit_id');
        $table->dropColumn('maintenance_date');
        $table->foreignId('maintenance_schedule_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('maintenance_histories', function (Blueprint $table) {
         $table->dropForeign('maintenance_schedule_id');
         });
    }
};
