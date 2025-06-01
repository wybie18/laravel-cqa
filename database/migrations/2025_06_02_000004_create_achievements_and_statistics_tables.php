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
        Schema::create('achievement_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('achievement_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->foreignId('achievement_category_id')->constrained()->onDelete('restrict');
            $table->string('icon')->nullable();
            $table->string('badge_color')->nullable();
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'epic', 'legendary'])->default('common');
            $table->integer('points')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_type_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->json('requirements');
            $table->integer('target_value')->nullable();
            $table->boolean('is_repeatable')->default(false);
            $table->integer('max_level')->default(1);
            $table->timestamps();
        });

        Schema::create('user_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('achievement_id')->constrained()->onDelete('cascade');
            $table->integer('level')->default(1);
            $table->integer('progress')->default(0);
            $table->timestamp('earned_at');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'achievement_id']);
        });

        Schema::create('achievement_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('achievement_id')->constrained()->onDelete('cascade');
            $table->json('progress_data');
            $table->integer('current_value')->default(0);
            $table->timestamp('last_updated_at');
            $table->timestamps();
            
            $table->unique(['user_id', 'achievement_id']);
        });

        Schema::create('user_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('courses_created')->default(0);
            $table->integer('courses_completed')->default(0);
            $table->integer('quizzes_taken')->default(0);
            $table->integer('quizzes_passed')->default(0);
            $table->integer('coding_exercises_completed')->default(0);
            $table->integer('typing_tests_taken')->default(0);
            $table->integer('achievement_points')->default(0);
            $table->integer('current_streak')->default(0);
            $table->integer('longest_streak')->default(0);
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
        });

        Schema::create('daily_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('activity_date');
            $table->integer('lessons_completed')->default(0);
            $table->integer('quizzes_taken')->default(0);
            $table->integer('code_submissions')->default(0);
            $table->integer('typing_tests_taken')->default(0);
            $table->integer('time_spent')->default(0);
            $table->timestamps();
            
            $table->unique(['user_id', 'activity_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_activities');
        Schema::dropIfExists('user_statistics');
        Schema::dropIfExists('achievement_progress');
        Schema::dropIfExists('user_achievements');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('achievement_types');
        Schema::dropIfExists('achievement_categories');
    }
};
