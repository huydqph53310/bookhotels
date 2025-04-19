<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'id' => 1,
                'name' => 'Vịnh Hạ Long',
                'slug' => 'vinh-ha-long',
                'description' => 'Di sản thiên nhiên thế giới với hàng nghìn hòn đảo đá vôi và hang động kỳ thú.',
                'image' => '/images/destinations/halong/main.jpg',
                'location' => 'Quảng Ninh',
                'rating' => 5
            ],
            [
                'id' => 2,
                'name' => 'Sapa',
                'slug' => 'sapa',
                'description' => 'Thị trấn trong mây với những ruộng bậc thang tuyệt đẹp và văn hóa dân tộc đặc sắc.',
                'image' => '/images/destinations/sapa/main.jpg',
                'location' => 'Lào Cai',
                'rating' => 5
            ],
            [
                'id' => 3,
                'name' => 'Ninh Bình',
                'slug' => 'ninh-binh',
                'description' => 'Vùng đất cố đô với những danh thắng nổi tiếng như Tràng An, Tam Cốc - Bích Động.',
                'image' => '/images/destinations/ninhbinh/main.jpg',
                'location' => 'Ninh Bình',
                'rating' => 5
            ],
            [
                'id' => 4,
                'name' => 'Đảo Cát Bà',
                'slug' => 'dao-cat-ba',
                'description' => 'Hòn đảo lớn nhất vịnh Hạ Long với những bãi biển đẹp và rừng quốc gia độc đáo.',
                'image' => '/images/destinations/catba/main.jpg',
                'location' => 'Hải Phòng',
                'rating' => 4
            ],
            [
                'id' => 5,
                'name' => 'Mai Châu',
                'slug' => 'mai-chau',
                'description' => 'Thung lũng xanh mướt với những ngôi nhà sàn truyền thống của người Thái.',
                'image' => '/images/destinations/maichau/main.jpg',
                'location' => 'Hòa Bình',
                'rating' => 4
            ],
            [
                'id' => 6,
                'name' => 'Mộc Châu',
                'slug' => 'moc-chau',
                'description' => 'Cao nguyên với những đồi chè xanh mướt và hoa mận, hoa đào nở rộ vào mùa xuân.',
                'image' => '/images/destinations/mocchau/main.jpg',
                'location' => 'Sơn La',
                'rating' => 4
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
