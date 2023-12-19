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
                'code' => 'SEASIDE2024123',
                'name_shop' => 'Thời trang nam Seaside',
                'discountPercentage' => null,
                'discountAmount' => '20000',
                'validFrom' => '2023/12/11 00:00:00',
                'validTo' => '2024/1/11 00:00:00',
                'usageLimit' => '15',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'SEASIDE2024',
                'name_shop' => 'Thời trang nam Seaside',
                'discountPercentage' => 10,
                'discountAmount' => null,
                'validFrom' => '2023/12/18 00:00:00',
                'validTo' => '2024/1/18 00:00:00',
                'usageLimit' => '10',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'SEASIDE1212',
                'name_shop' => 'Thời trang nam Seaside',
                'discountPercentage' => 20,
                'discountAmount' => null,
                'validFrom' => '2023/12/10 00:00:00',
                'validTo' => '2023/12/13 00:00:00',
                'usageLimit' => '10',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'SEASIDE2512',
                'name_shop' => 'Thời trang nam Seaside',
                'discountPercentage' => 10,
                'discountAmount' => null,
                'validFrom' => '2023/12/24 00:00:00',
                'validTo' => '2023/12/26 00:00:00',
                'usageLimit' => '10',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'UMI123',
                'name_shop' => 'GIÀY UMI',
                'discountPercentage' => 20,
                'discountAmount' => null,
                'validFrom' => '2023/12/18 00:00:00',
                'validTo' => '2024/1/18 00:00:00',
                'usageLimit' => '15',
                'platformVoucher' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'SS112024',
                'name_shop' => null,
                'discountPercentage' => 15,
                'discountAmount' => null,
                'validFrom' => '2023/12/15 00:00:00',
                'validTo' => '2024/1/5 00:00:00',
                'usageLimit' => '20',
                'platformVoucher' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);
    }
}
