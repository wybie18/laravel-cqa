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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false);
            $table->integer('passing_score')->default(70);
            $table->timestamps();
        });

        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_type_id')->constrained()->onDelete('restrict');
            $table->text('question_text');
            $table->json('options')->nullable();
            $table->text('correct_answer')->nullable();
            $table->text('explanation')->nullable();
            $table->integer('points')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('programming_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('version')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('code_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('programming_language_id')->constrained()->onDelete('restrict');
            $table->text('code');
            $table->text('output')->nullable();
            $table->text('error')->nullable();
            $table->integer('execution_time')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->integer('score')->nullable();
            $table->timestamps();
        });

        Schema::create('typing_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('text_content');
            $table->integer('time_limit')->default(60);
            $table->string('difficulty')->default('medium');
            $table->timestamps();
        });

        Schema::create('typing_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('typing_test_id')->constrained()->onDelete('cascade');
            $table->integer('wpm');
            $table->decimal('accuracy', 5, 2);
            $table->integer('characters_typed');
            $table->integer('errors');
            $table->integer('time_taken');
            $table->timestamps();
        });

        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->text('answer');
            $table->text('hint')->nullable();
            $table->integer('difficulty')->default(1);
            $table->timestamps();
        });

        Schema::create('user_flashcard_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('flashcard_id')->constrained()->onDelete('cascade');
            $table->integer('correct_count')->default(0);
            $table->integer('incorrect_count')->default(0);
            $table->timestamp('last_reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_flashcard_progress');
        Schema::dropIfExists('flashcards');
        Schema::dropIfExists('user_progress');
        Schema::dropIfExists('typing_test_results');
        Schema::dropIfExists('typing_tests');
        Schema::dropIfExists('code_submissions');
        Schema::dropIfExists('programming_languages');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_types');
        Schema::dropIfExists('quizzes');
    }
};
