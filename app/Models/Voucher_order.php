<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class Voucher_order extends Model
{
    use HasFactory;
    protected $table = 'voucher_order';
    protected $primaryKey = 'id';
    protected $fillable = ['id_order', 'voucher_code','created_at', 'updated_at'];

    public static function saveVoucher($orderId, $voucherCode)
    {
        self::create([
            'id_order' => $orderId,
            'voucher_code' => $voucherCode,
        ]);
        $voucher = Voucher::where('id', $voucherCode)->first();

        if ($voucher) {
            $voucher->decrement('usageLimit');
        
            $voucher->increment('platformVoucher');
        }
    }
}
