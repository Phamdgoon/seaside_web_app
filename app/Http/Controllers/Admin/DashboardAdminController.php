<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerProfile;
use App\Models\ShopProfile;
use App\Models\Order_Detail;
use App\Models\Voucher;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $countBuyer = BuyerProfile::count();
        $countShop = ShopProfile::where('approved', 1)->count();
        $totalOrder = Order_Detail::sum('price') * 0.1;
        $totalVoucher = Voucher::whereNull('id_shop')->sum(\DB::raw('discountAmount * platformVoucher'));
        
        return view('admin.home.index', [
            'countBuyer' => $countBuyer, 
            'countShop' => $countShop,
            'totalOrder' => $totalOrder,
            'totalVoucher' => $totalVoucher,
        ]);
    }
}
