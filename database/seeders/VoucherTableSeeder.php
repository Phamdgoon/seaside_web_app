<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        DB::table('voucher')->insert([
            [
                'code' => 'UMITET2024123',
                'name_shop' => 'UMI SHOES',
                'discountPercentage' => '10',
                'discountAmount' => '20',
                'validFrom' => '2023/12/11 00:00:00',
                'validTo' => '2024/1/11 00:00:00',
                'usageLimit' => '15',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'HAVANA2512',
                'name_shop' => 'HAVANA FASHION',
                'discountPercentage' => '15',
                'discountAmount' => '30',
                'validFrom' => '2023/12/25 00:00:00',
                'validTo' => '2023/12/30 00:00:00',
                'usageLimit' => '25',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'MENFASHION123',
                'name_shop' => 'MEN FASHION',
                'discountPercentage' => '20',
                'discountAmount' => '40',
                'validFrom' => '2023/12/15 00:00:00',
                'validTo' => '2023/12/25 00:00:00',
                'usageLimit' => '5',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'ROGERTET2024',
                'name_shop' => 'ROGE.VN',
                'discountPercentage' => '15',
                'discountAmount' => '25',
                'validFrom' => '2023/12/10 00:00:00',
                'validTo' => '2024/1/10 00:00:00',
                'usageLimit' => '30',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ]);
    }
}
