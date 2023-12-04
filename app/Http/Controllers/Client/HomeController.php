<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Images;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select('product.id', 'product.name_product', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
            ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
            ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
            ->groupBy('product.id', 'product.name_product') // Thêm 'product.name_product' vào danh sách GROUP BY
            ->orderBy('product.name_product')
            ->orderBy('price')
            ->orderBy('url_image')
            ->get();
        $categorys = Category::all();
        return view('client.home.index', [
            'products' => $products,
            'categorys' => $categorys
        ]);
    }
    public function filter(Request $request){
        $categoryId = $request->input('category_id');
        $products = Product::select('product.id', 'product.name_product','product.id_category', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
            ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
            ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
            ->groupBy('product.id', 'product.name_product','product.id_category') // Thêm 'product.name_product' vào danh sách GROUP BY
            ->orderBy('product.name_product')
            ->orderBy('price')
            ->orderBy('url_image')
            ->where('product.id_category',$categoryId)
            ->get();
        $categorys = Category::all();
        return view('client.home.index', [
            'products' => $products,
            'categorys' => $categorys
        ]);
    }

}
