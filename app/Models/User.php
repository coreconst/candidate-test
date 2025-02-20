<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\TestStatus;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
        'role',
        'password',
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
        ];
    }

    public function ownTests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function assignedTests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class, 'user_tests')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function assignments(): HasManyThrough
    {
        return $this->hasManyThrough(UserTest::class, Test::class);
    }

    public function userTests(): HasMany
    {
        return $this->hasMany(UserTest::class);
    }

    /**
     * Assign test for user
     *
     * @param int $testId
     * @param string $status
     * @return void
     */
    public function assignTest(int $testId, string $status = TestStatus::InProgress->value): void
    {
        $this->assignedTests()->attach($testId, ['status' => $status]);
    }

    public function isRecruiter(): bool
    {
        return $this->role === UserRole::Recruiter->value;
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
