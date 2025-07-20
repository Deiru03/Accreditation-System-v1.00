<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable //implements MustVerifyEmail
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
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'password',
        'user_type',
        'employee_id',
        'phone_number',
        'address',
        'status',
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
            'approved_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    //Implementing the MustVerifyEmail interface is optional
     // Relationships for approval system
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function approvedUsers(): HasMany
    {
        return $this->hasMany(User::class, 'approved_by');
    }

    // User Type Checking Methods
    public function isIQA(): bool
    {
        return $this->user_type === 'iqa';
    }

    public function isValidator(): bool
    {
        return $this->user_type === 'validator';
    }

    public function isAccreditor(): bool
    {
        return $this->user_type === 'accreditor';
    }

    public function isUploader(): bool
    {
        return $this->user_type === 'uploader';
    }

    // Status Checking Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return !is_null($this->approved_at);
    }

    // Helper Methods
    public function getFullNameAttribute(): string
    {
        $name = $this->first_name;
        
        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }
        
        $name .= ' ' . $this->last_name;
        
        return $name;
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->last_name . ', ' . $this->first_name . ($this->middle_name ? ' ' . substr($this->middle_name, 0, 1) . '.' : '');
    }

    public function getUserTypeDisplayAttribute(): string
    {
        return match($this->user_type) {
            'iqa' => 'IQA Administrator',
            'validator' => 'Validator',
            'accreditor' => 'Accreditor', 
            'uploader' => 'Program Coordinator',
            default => 'Unknown'
        };
    }
}
