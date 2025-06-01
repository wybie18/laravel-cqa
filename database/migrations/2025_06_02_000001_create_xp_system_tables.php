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
        Schema::create('xp_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->integer('base_xp');
            $table->json('multipliers')->nullable();
            $table->boolean('is_repeatable')->default(true);
            $table->integer('daily_limit')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('xp_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->integer('xp_required');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('badge_icon')->nullable();
            $table->string('badge_color')->nullable();
            $table->json('rewards')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique('level');
            $table->unique('xp_required');
        });

        Schema::create('xp_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('xp_source_id')->constrained()->onDelete('restrict');
            $table->integer('xp_amount');
            $table->integer('multiplier_applied')->default(100);
            $table->integer('final_xp');
            
            $table->string('source_type');
            $table->unsignedBigInteger('source_id');
            
            $table->json('metadata')->nullable();
            $table->text('reason')->nullable();
            $table->boolean('is_bonus')->default(false);
            $table->timestamp('earned_at');
            $table->timestamps();
            
            $table->index(['source_type', 'source_id']);
            $table->index(['user_id', 'earned_at']);
        });

        Schema::create('user_xp_summary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('daily_xp')->default(0);
            $table->integer('total_xp_end_of_day');
            $table->json('xp_breakdown')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'date']);
            $table->index(['user_id', 'date']);
        });

        Schema::create('xp_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('restrict');
            $table->integer('xp_change');
            $table->text('reason');
            $table->enum('type', ['correction', 'bonus', 'penalty', 'migration']);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xp_adjustments');
        Schema::dropIfExists('user_xp_summary');
        Schema::dropIfExists('xp_transactions');
        Schema::dropIfExists('xp_levels');
        Schema::dropIfExists('xp_sources');
    }
};
