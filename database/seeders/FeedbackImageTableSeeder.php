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
                'url_image' => 'https://i.pinimg.com/564x/a9/c0/ed/a9c0eda54134f2860f430326135c2fbb.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id_feedback' => '2',
                'url_image' => 'https://i.pinimg.com/564x/99/fc/7f/99fc7fd57818266c7e88749b453b9841.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id_feedback' => '3',
                'url_image' => 'https://i.pinimg.com/564x/ea/3f/3f/ea3f3f0df6beb8e35b122b5cb9809440.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
