<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'name', 'description', 'capacity',
        'price_per_night', 'amenities', 'bed_type',
        'room_size', 'view_type', 'room_images', 'quantity',
        'room_type', 'price', 'status', 'image'
    ];

    protected $casts = [
        'amenities' => 'array',
        'room_images' => 'array',
        'price' => 'decimal:2'
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
