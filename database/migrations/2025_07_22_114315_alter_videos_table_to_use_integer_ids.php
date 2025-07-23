<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('videos', function (Blueprint $table) {
            // Drop dulu kalau kolom lama ada
            if (Schema::hasColumn('videos', 'course_id')) {
                $table->dropColumn('course_id');
            }
            if (Schema::hasColumn('videos', 'learning_session_id')) {
                $table->dropColumn('learning_session_id');
            }
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->after('id');
            $table->unsignedBigInteger('learning_session_id')->nullable()->after('course_id');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('learning_session_id')->references('id')->on('learning_sessions')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['learning_session_id']);
            $table->dropColumn(['course_id', 'learning_session_id']);
        });
    }
};
