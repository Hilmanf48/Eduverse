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
        Schema::table('quizzes', function (Blueprint $table) {
       
        if (Schema::hasColumn('quizzes', 'course_id')) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        }

        $table->foreignId('learning_session_id')->nullable()->constrained()->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
        $table->dropForeign(['learning_session_id']);
        $table->dropColumn('learning_session_id');

        $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
    });
    }
};
