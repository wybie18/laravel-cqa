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
        Schema::create('report_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_category_id')->constrained()->onDelete('restrict');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('requires_evidence')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('reportable_content_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('table_name');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reportable_content_type_id')->constrained()->onDelete('restrict');
            $table->unsignedBigInteger('reportable_content_id');
            $table->foreignId('report_type_id')->constrained()->onDelete('restrict');
            $table->text('description');
            $table->json('evidence')->nullable();
            $table->enum('status', ['pending', 'investigating', 'resolved', 'rejected'])->default('pending');
            $table->text('resolution_notes')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index(['reportable_content_type_id', 'reportable_content_id']);
        });

        Schema::create('feedback_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('feedback_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_category_id')->constrained()->onDelete('restrict');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('requires_details')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('feedback_content_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('table_name');
            $table->timestamps();
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('feedback_content_type_id')->constrained()->onDelete('restrict');
            $table->unsignedBigInteger('feedbackable_content_id');
            $table->foreignId('feedback_type_id')->constrained()->onDelete('restrict');
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamps();
            
            $table->index(['feedback_content_type_id', 'feedbackable_content_id']);
        });

        Schema::create('feedback_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('reply');
            $table->boolean('is_internal')->default(false);
            $table->timestamps();
        });

        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('flag');
            $table->integer('points');
            $table->json('file_paths')->nullable();
            $table->string('category');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('problem_id')->constrained()->onDelete('cascade');
            $table->boolean('is_correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('problems');
        Schema::dropIfExists('feedback_replies');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('feedback_content_types');
        Schema::dropIfExists('feedback_types');
        Schema::dropIfExists('feedback_categories');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('reportable_content_types');
        Schema::dropIfExists('report_types');
        Schema::dropIfExists('report_categories');
    }
};
