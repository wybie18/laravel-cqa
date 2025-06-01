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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typing_test_results');
        Schema::dropIfExists('typing_tests');
        Schema::dropIfExists('code_submissions');
        Schema::dropIfExists('programming_languages');
    }
};
