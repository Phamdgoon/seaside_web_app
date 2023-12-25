<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shop_profile')->insert([
            [
                'name_shop' => 'Thời trang nam Seaside',
                'username' => 'hongkhanh',
                'address' => '41 Cao Thắng, Hải Châu, Đà Nẵng',
                'cover_image' => 'https://ketnoikhonggian.com/anh/giangluxury/shop-thoi-trang-nu-giang-luxury-2.webp',
                'avt' => 'https://toplist.vn/images/800px/4men-814792.jpg',
                'approved'=> 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name_shop' => 'GIÀY UMI',
                'username' => 'thaonguyet',
                'address' => '50 Lê Duẩn, Thanh Khê, Đà Nẵng',
                'cover_image' => 'https://sieuthigiake.com/img/trung-bay-giay-dep-an-tuong.jpg',
                'avt' => 'https://down-tx-vn.img.susercontent.com/2153b0f9c25fc516ca0ba291f8ba35f1_tn',
                'approved'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
