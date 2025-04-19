<?php

function downloadImage($url, $path) {
    $dir = dirname($path);
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    // Thêm query string để lấy kích thước ảnh phù hợp
    $url = $url . "?auto=format&fit=crop&w=1200&q=80";

    $ch = curl_init($url);
    $fp = fopen($path, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

$images = [
    // Logo
    'public/images/logo/logo.png' => 'https://i.ibb.co/9gGGfRz/logo.png',
    'public/images/logo/logo-white.png' => 'https://i.ibb.co/0jZ3Q5F/logo-white.png',

    // Hero Images
    'public/images/hero/halong.jpg' => 'https://images.unsplash.com/photo-1528127269322-539801943592',
    'public/images/hero/sapa.jpg' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff',
    'public/images/hero/hanoi.jpg' => 'https://images.unsplash.com/photo-1509030450996-86d2f1bf00cc',
    'public/images/hero/ninhbinh.jpg' => 'https://images.unsplash.com/photo-1562244510-10f9a4b10337',

    // Destinations - Halong
    'public/images/destinations/halong/main.jpg' => 'https://images.unsplash.com/photo-1573270689103-d7a4e42b1c74',
    'public/images/destinations/halong/cave.jpg' => 'https://i.ibb.co/3RZ9QXg/halong-cave.jpg',
    'public/images/destinations/halong/beach.jpg' => 'https://i.ibb.co/f8ZXVY0/halong-beach.jpg',

    // Destinations - Sapa
    'public/images/destinations/sapa/main.jpg' => 'https://images.unsplash.com/photo-1602765413500-70afd5370473',
    'public/images/destinations/sapa/village.jpg' => 'https://i.ibb.co/Lp7T2Yg/sapa-village.jpg',
    'public/images/destinations/sapa/fansipan.jpg' => 'https://i.ibb.co/0M8yHXZ/sapa-fansipan.jpg',

    // Destinations - Hanoi
    'public/images/destinations/hanoi/main.jpg' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482',
    'public/images/destinations/hanoi/oldquarter.jpg' => 'https://i.ibb.co/Kx2Lg8Y/hanoi-oldquarter.jpg',
    'public/images/destinations/hanoi/temple.jpg' => 'https://i.ibb.co/3WXp9Xq/hanoi-temple.jpg',

    // Hotels - Halong
    'public/images/hotels/halong/vinpearl.jpg' => 'https://i.ibb.co/C1L8Zn4/vinpearl-halong.jpg',
    'public/images/hotels/halong/novotel.jpg' => 'https://i.ibb.co/YPXnJKF/novotel-halong.jpg',
    'public/images/hotels/halong/wyndham.jpg' => 'https://i.ibb.co/0jZ3qKm/wyndham-halong.jpg',

    // Hotels - Hanoi
    'public/images/hotels/hanoi/metropole.jpg' => 'https://i.ibb.co/Nx7RPJL/metropole-hanoi.jpg',
    'public/images/hotels/hanoi/intercontinental.jpg' => 'https://i.ibb.co/wYdGZxM/intercontinental-hanoi.jpg',
    'public/images/hotels/hanoi/lotte.jpg' => 'https://i.ibb.co/3vL8Qjq/lotte-hanoi.jpg',

    // Rooms
    'public/images/rooms/deluxe/room1.jpg' => 'https://i.ibb.co/Kj8vTZQ/deluxe-room.jpg',
    'public/images/rooms/suite/room2.jpg' => 'https://i.ibb.co/3RZ9QXg/suite-room.jpg',
    'public/images/rooms/presidential/room3.jpg' => 'https://i.ibb.co/f8ZXVY0/presidential-room.jpg',

    // Amenities
    'public/images/amenities/pool.jpg' => 'https://i.ibb.co/Nx7RPJL/pool.jpg',
    'public/images/amenities/spa.jpg' => 'https://i.ibb.co/wYdGZxM/spa.jpg',
    'public/images/amenities/gym.jpg' => 'https://i.ibb.co/3vL8Qjq/gym.jpg',
    'public/images/amenities/restaurant.jpg' => 'https://i.ibb.co/C1L8Zn4/restaurant.jpg',

    // Testimonials
    'public/images/testimonials/avatar1.jpg' => 'https://i.ibb.co/YPXnJKF/avatar1.jpg',
    'public/images/testimonials/avatar2.jpg' => 'https://i.ibb.co/0jZ3qKm/avatar2.jpg',
    'public/images/testimonials/avatar3.jpg' => 'https://i.ibb.co/Nx7RPJL/avatar3.jpg',
    'public/images/testimonials/avatar4.jpg' => 'https://i.ibb.co/wYdGZxM/avatar4.jpg',
];

foreach ($images as $path => $url) {
    echo "Downloading: $path\n";
    try {
        downloadImage($url, $path);
        echo "Successfully downloaded: $path\n";
    } catch (Exception $e) {
        echo "Error downloading: $path - " . $e->getMessage() . "\n";
    }
}

echo "Download process completed!\n";
