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
        $shopProfileInfos = ShopProfile::with(['products.productDetail.productImage'])->where('name_shop', $nameShop)->get();

        // Lấy danh sách các sản phẩm của cửa hàng
        $products = $shopProfileInfos->pluck('products')->flatten();

        // Lấy danh sách danh mục con (category_child) từ các sản phẩm
        $category_childs = $products->pluck('category_child')->flatten()->unique();


        return view('buyer.profile-seller.index', compact('shopProfileInfos', 'nameShop', 'category_childs', 'products',));
    }
}
