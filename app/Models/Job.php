<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $table = 'job_posts';

    protected $fillable = [
        'title', 'description', 'location', 'type', 'experience_level', 'salary_min', 'salary_max',
        'deadline', 'category', 'employer_id', 'is_approved', 'company_logo'
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    // Helper method to maintain compatibility with existing code
    public function getStatusAttribute()
    {
        return $this->is_approved ? 'approved' : 'pending';
    }

    // Helper method to maintain compatibility with existing code
    public function setStatusAttribute($value)
    {
        $this->attributes['is_approved'] = ($value === 'approved');
    }
}
