<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Top 10 Địa Điểm Du Lịch Miền Bắc Không Thể Bỏ Qua',
                'excerpt' => 'Khám phá những điểm đến tuyệt vời nhất tại miền Bắc Việt Nam, từ vịnh Hạ Long hùng vĩ đến những bản làng yên bình trên cao nguyên đá Hà Giang.',
                'content' => 'Miền Bắc Việt Nam là một kho báu của những địa điểm du lịch tuyệt vời. Từ những di sản thế giới như vịnh Hạ Long đến những thung lũng xanh mướt của Sapa, mỗi điểm đến đều mang một vẻ đẹp riêng biệt...',
                'image' => '/images/blog/halong.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Ẩm Thực Hà Nội - Hành Trình Khám Phá Hương Vị Thủ Đô',
                'excerpt' => 'Khám phá nét đặc trưng trong văn hóa ẩm thực Hà Nội qua những món ăn truyền thống và những quán ăn lâu đời.',
                'content' => 'Hà Nội nổi tiếng với nền ẩm thực phong phú và đa dạng. Từ những quán phở truyền thống đến các món ăn đường phố độc đáo, mỗi món ăn đều mang trong mình một câu chuyện văn hóa riêng...',
                'image' => '/images/blog/hanoi-food.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Kinh Nghiệm Du Lịch Sapa Mùa Hoa Đào',
                'excerpt' => 'Tất tần tật những điều cần biết khi du lịch Sapa vào mùa hoa đào, từ thời tiết, trang phục đến địa điểm check-in.',
                'content' => 'Sapa vào mùa hoa đào là một trong những điểm đến hấp dẫn nhất miền Bắc. Với không khí se lạnh và những cánh hoa đào phớt hồng, Sapa mang đến cho du khách những trải nghiệm khó quên...',
                'image' => '/images/blog/sapa-spring.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Khám Phá Vẻ Đẹp Hoang Sơ Của Đảo Cô Tô',
                'excerpt' => 'Hướng dẫn chi tiết về cách đi, nơi ở và những điểm tham quan không thể bỏ qua tại đảo Cô Tô.',
                'content' => 'Đảo Cô Tô là một viên ngọc ẩn của vùng biển miền Bắc. Với những bãi biển trong xanh, hoang sơ và những rặng dừa xanh mát, Cô Tô là điểm đến lý tưởng cho những ai muốn trốn khỏi sự ồn ào của thành phố...',
                'image' => '/images/blog/coto-island.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Mùa Thu Hà Nội - Những Điểm Chụp Ảnh Đẹp Nhất',
                'excerpt' => 'Gợi ý những địa điểm chụp ảnh tuyệt đẹp trong mùa thu Hà Nội, từ hồ Gươm đến những con phố cổ.',
                'content' => 'Mùa thu Hà Nội nổi tiếng với những hàng cây lá vàng và không khí se lạnh dễ chịu. Đây là thời điểm tuyệt vời để dạo quanh phố phường và ghi lại những khoảnh khắc đẹp của thủ đô...',
                'image' => '/images/blog/hanoi-autumn.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Những Resort Nghỉ Dưỡng Đẳng Cấp Tại Vịnh Hạ Long',
                'excerpt' => 'Điểm danh những khu nghỉ dưỡng sang trọng bậc nhất tại vịnh Hạ Long, nơi hội tụ giữa thiên nhiên và đẳng cấp.',
                'content' => 'Vịnh Hạ Long không chỉ nổi tiếng với cảnh quan thiên nhiên tuyệt đẹp mà còn sở hữu nhiều khu nghỉ dưỡng đẳng cấp quốc tế. Từ những villa sang trọng đến những suite view biển, mỗi nơi đều mang đến trải nghiệm độc đáo...',
                'image' => '/images/blog/halong-resort.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Lễ Hội Mùa Xuân Miền Bắc - Nét Đẹp Văn Hóa Truyền Thống',
                'excerpt' => 'Tìm hiểu về những lễ hội đặc sắc trong mùa xuân miền Bắc, từ hội Lim đến hội Gióng.',
                'content' => 'Mùa xuân miền Bắc không chỉ có không khí se lạnh và hoa đào nở rộ mà còn là mùa của những lễ hội truyền thống đặc sắc. Mỗi lễ hội đều mang trong mình những giá trị văn hóa độc đáo của dân tộc...',
                'image' => '/images/blog/spring-festival.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Khám Phá Ẩm Thực Đường Phố Hạ Long',
                'excerpt' => 'Tour ẩm thực qua những món ngon đặc trưng của vùng biển Hạ Long, từ hải sản tươi sống đến những món ăn vặt độc đáo.',
                'content' => 'Hạ Long không chỉ nổi tiếng với vịnh biển xinh đẹp mà còn có một nền ẩm thực đường phố phong phú. Từ những quán hải sản tươi sống đến những gánh hàng rong, mỗi món ăn đều mang đậm hương vị biển...',
                'image' => '/images/blog/halong-food.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Homestay Đẹp Tại Tam Đảo - Trải Nghiệm Sống Ảo Giữa Mây',
                'excerpt' => 'Giới thiệu những homestay có view đẹp và thiết kế độc đáo tại Tam Đảo, điểm đến hot của giới trẻ.',
                'content' => 'Tam Đảo đang trở thành điểm đến hot với nhiều homestay độc đáo. Nằm giữa những tầng mây, các homestay tại đây không chỉ mang đến không gian nghỉ dưỡng thoải mái mà còn là địa điểm check-in tuyệt vời...',
                'image' => '/images/blog/tamdao-homestay.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
