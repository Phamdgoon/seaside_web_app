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
                'approved' => 1,
                'name_shop' => 'Thời trang nam Seaside',
                'username' => 'hongkhanh',
                'address' => '41 Cao Thắng, Hải Châu, Đà Nẵng',
                'cover_image' => 'cover-ttnss.jpg',
                'avt' => 'avt-ttnss.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'approved' => 1,
                'name_shop' => 'GIÀY UMI',
                'username' => 'thaonguyet',
                'address' => '50 Lê Duẩn, Thanh Khê, Đà Nẵng',
                'cover_image' => 'cover-gum.jpg',
                'avt' => 'avt-gum.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
