<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'location',
        'price',
        'rating',
        'amenities',
        'contact_phone',
        'contact_email',
        'address',
        'latitude',
        'longitude',
        'check_in_time',
        'check_out_time',
        'status', // active, inactive, maintenance
        'destination_id',
        'total_rooms',
        'available_rooms'
    ];

    protected $casts = [
        'amenities' => 'array',
        'price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // Accessors & Mutators
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . ' VNĐ';
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? $this->rating;
    }

    public function getAvailabilityStatusAttribute()
    {
        return $this->available_rooms > 0 ? 'Còn phòng' : 'Hết phòng';
    }
}
