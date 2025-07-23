<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('user_progress');
        
        // Hapus record migrasi terkait
        DB::table('migrations')->whereIn('migration', [
            '2025_07_16_154105_create_user_progress_table',
            '2025_07_16_170552_add_lesson_id_to_user_progress_table',
            '2025_07_16_170915_add_user_id_to_user_progress_table'
        ])->delete();
    }

    public function down()
    {
        // Untuk rollback (opsional)
        Schema::create('user_progress', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lesson_id')->constrained();
            $table->timestamps();
        });
    }
};