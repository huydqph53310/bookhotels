<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'destination_id' => 1, // Hạ Long
                'name' => 'Vinpearl Resort & Spa Hạ Long',
                'slug' => 'vinpearl-resort-spa-ha-long',
                'description' => 'Khu nghỉ dưỡng 5 sao với tầm nhìn tuyệt đẹp ra vịnh Hạ Long.',
                'image' => '/images/hotels/halong/vinpearl.jpg',
                'location' => 'Hạ Long, Quảng Ninh',
                'price' => 2500000,
                'rating' => 5,
                'amenities' => json_encode([
                    'Hồ bơi',
                    'Spa',
                    'Nhà hàng',
                    'Phòng gym',
                    'Bar',
                    'WiFi miễn phí',
                    'Đưa đón sân bay'
                ]),
                'contact_phone' => '02033846810',
                'contact_email' => 'booking@vinpearlhalong.com',
                'address' => 'Đảo Rều, Phường Bãi Cháy, TP. Hạ Long, Quảng Ninh',
                'latitude' => 20.958889,
                'longitude' => 107.078889,
                'check_in_time' => '14:00:00',
                'check_out_time' => '12:00:00',
                'status' => 'active',
                'total_rooms' => 100,
                'available_rooms' => 30
            ],
            [
                'destination_id' => 2,
                'name' => 'Silk Path Grand Resort & Spa Sapa',
                'slug' => 'silk-path-grand-resort-spa-sapa',
                'description' => 'Resort sang trọng với kiến trúc độc đáo và view núi tuyệt đẹp.',
                'image' => '/images/hotels/sapa/sapa-jade.jpg',
                'location' => 'Sapa, Lào Cai',
                'price' => 1800000,
                'rating' => 5,
                'amenities' => json_encode([
                    'Nhà hàng',
                    'Spa',
                    'Phòng họp',
                    'Bar',
                    'WiFi miễn phí',
                    'Đưa đón sân bay'
                ]),
                'contact_phone' => '02143626999',
                'contact_email' => 'info@silkpathsapa.com',
                'address' => 'Đường Mường Hoa, Thị xã Sapa, Lào Cai',
                'latitude' => 22.313889,
                'longitude' => 103.844444,
                'check_in_time' => '14:00:00',
                'check_out_time' => '12:00:00',
                'status' => 'active',
                'total_rooms' => 80,
                'available_rooms' => 25
            ],
            // Thêm các khách sạn khác tương tự
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
