<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category_Child;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $shopProfileInfos = ShopProfile::with(['products.productDetail'])->where('name_shop', $nameShop)->get();

        // Lấy danh sách các sản phẩm của cửa hàng
        $products = $shopProfileInfos->pluck('products')->flatten();

        // Lấy danh sách danh mục con (category_child) từ các sản phẩm
        $category_childs = $products->pluck('category_child')->flatten()->unique();

        // Tính trung bình số sao cho từng sản phẩm
        $averageRatingsPerProduct = [];

        foreach ($products as $product) {
            $ratings = $product->orderDetails
                ->flatMap(function ($orderDetail) {
                    return $orderDetail->feedbacks->pluck('star');
                })
                ->filter();

            $averageRatingsPerProduct[$product->id] = $ratings->isNotEmpty() ? $ratings->avg() : 0;
        }

        // Tính trung bình cộng số sao cho toàn bộ shop
        $allRatings = collect($averageRatingsPerProduct)
            ->filter(function ($averageRating) {
                return $averageRating > 0;
            });

        $averageRatingForShop = $allRatings->isNotEmpty() ? $allRatings->avg() : 0;

        return view('buyer.profile-seller.index', compact('shopProfileInfos', 'nameShop', 'category_childs', 'products', 'averageRatingForShop'));
    }
}
