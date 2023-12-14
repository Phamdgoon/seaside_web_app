<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category_Child;
use App\Models\Product;
use App\Models\Shop_profile;
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

    public function index(Shop_profile $shop_profile)
    {
        $category_childs = $shop_profile->category_child;
        $products = $shop_profile->product;
        return view('client.profile-seller.index', compact('category_childs', 'products'));
    }
}
