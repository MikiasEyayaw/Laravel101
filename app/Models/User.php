<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Listing;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'is_approved',
        'is_active',
        'rejection_reason',
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
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
            'approved_at' => 'datetime',
            'deactivated_at' => 'datetime',
        ];
    }
    //Relationship with Listings
    public function listings(){
        return $this->hasMany(Listing::class,'user_id');
    }

    // Check if user is approved
    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    // Check if user is active
    public function isActive(): bool
    {
        return $this->is_active;
    }

    // Check if user can create listings
    public function canCreateListings(): bool
    {
        return $this->is_approved && $this->is_active;
    }

    // Scope to get only approved users
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Scope to get pending users
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    // Scope to get active users
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope to get inactive users
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
