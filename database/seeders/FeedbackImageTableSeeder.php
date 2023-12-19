<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FeedbackImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        DB::table('feedback_image')->insert([
            [
                'id_feedback' => '1',
                'url_image' => 'https://lzd-img-global.slatic.net/g/ff/kf/S05cd6ff908244fbfbf2a104124881b6eI.jpg_720x720q80.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id_feedback' => '2',
                'url_image' => 'https://sakurafashion.vn/upload/a/4959-torano-7242.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id_feedback' => '3',
                'url_image' => 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lll2dq3yxgsve5_tn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
