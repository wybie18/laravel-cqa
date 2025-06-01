<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'total_xp',
        'current_level',
        'xp_to_next_level',
        'xp_last_updated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'total_xp' => 'integer',
            'current_level' => 'integer',
            'xp_to_next_level' => 'integer',
            'xp_last_updated' => 'datetime',
        ];
    }

    /**
     * Get the statistics associated with the user.
     */
    public function statistics()
    {
        return $this->hasOne(UserStatistics::class);
    }

    /**
     * Get the user's daily activities.
     */
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }

    /**
     * Get the user's courses.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Get the user's XP transactions.
     */
    public function xpTransactions()
    {
        return $this->hasMany(XpTransaction::class);
    }

    /**
     * Get the user's progress.
     */
    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    /**
     * Get the user's flashcard progress.
     */
    public function flashcardProgress()
    {
        return $this->hasMany(UserFlashcardProgress::class);
    }

    /**
     * Get the user's achievements.
     */
    public function achievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

    /**
     * Get the user's achievement progress.
     */
    public function achievementProgress()
    {
        return $this->hasMany(AchievementProgress::class);
    }

    /**
     * Get the user's code submissions.
     */
    public function codeSubmissions()
    {
        return $this->hasMany(CodeSubmission::class);
    }

    /**
     * Get the user's typing test results.
     */
    public function typingTestResults()
    {
        return $this->hasMany(TypingTestResult::class);
    }

    /**
     * Get the user's XP summary.
     */
    public function xpSummary()
    {
        return $this->hasMany(UserXpSummary::class);
    }

    /**
     * Get the user's submissions for problems.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
