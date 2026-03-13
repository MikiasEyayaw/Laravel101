<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'company',
        'location',
        'email',
        'website',
        'tags',
        'description',
        'logo',
        'is_approved',
        'rejection_reason',
        'featured_until',
        'user_id'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'featured_until' => 'datetime',
        'is_approved' => 'boolean',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }

    //Relationship TO User
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    // Check if listing is approved
    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    // Check if listing is featured
    public function isFeatured(): bool
    {
        return $this->featured_until && $this->featured_until > now();
    }

    // Scope to get only approved listings
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Scope to get pending listings
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    // Scope to get featured listings
    public function scopeFeatured($query)
    {
        return $query->where('featured_until', '>', now());
    }
}
