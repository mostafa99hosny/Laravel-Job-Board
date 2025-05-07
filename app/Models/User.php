<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'resume_path',
        'bio'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Role helpers
    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }

    public function isCandidate(): bool
    {
        return $this->role === 'candidate';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Relationships
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'candidate_id');
    }
}
