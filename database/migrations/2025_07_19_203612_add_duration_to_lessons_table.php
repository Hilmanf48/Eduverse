<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('duration')->default(5)->comment('Duration in minutes');
        });
    
    // Update nilai existing
        DB::table('lessons')->update(['duration' => 5]); // Default 5 menit
    }

/**
 * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
        $table->dropColumn('duration');
        });
    }
};
