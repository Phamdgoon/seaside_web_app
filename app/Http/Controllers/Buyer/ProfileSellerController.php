<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category_Child;
use App\Models\Product;
use App\Models\ShopProfile;
use Illuminate\Http\Request;

class ProfileSellerController extends Controller
{
    protected $category_child;
    protected $product;

    public function __construct(Product $product, Category_Child $category_child)
    {
        $this->product = $product;
        $this->category_child = $category_child;
    }

    public function getInforShop(Request $request)
    {
        $nameShop = $request->input('name_shop');
        $shopProfileInfos = ShopProfile::where('name_shop', $nameShop)->get();
       dd($shopProfileInfos);
        

        return view('buyer.profile-seller.index', compact('shopProfileInfos', 'nameShop'));
    }
}
