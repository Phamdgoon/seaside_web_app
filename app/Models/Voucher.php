<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $fillable = ['voucher_code', 'name_shop', 'discountPercentage', 'discountAmount', 'validFrom', 'validTo', 'usageLimit', 'platformVoucher', 'created_at', 'updated_at'];

    public function shopProfile()
    {
        return $this->belongsTo(ShopProfile::class, 'name_shop', 'name_shop');
    }
}
