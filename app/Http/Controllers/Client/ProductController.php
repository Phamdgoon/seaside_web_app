<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Images;
use App\Models\Category_Child;

class ProductController extends Controller
{
    public function product(Request $request){
        $categoryId = $request->input('id');
        $category_Childs = Category_Child::where('id_category',$categoryId)->get();
        $products = [];
        session()->put('id_category', $categoryId);
        foreach ($category_Childs as $categoryChild) {
            $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                ->where('product.id_category_child', $categoryChild->id)
                ->get();
        
            $products = array_merge($products, $product->toArray());
        }
        
        return view('client.product.product', [
            'products' => $products,
        ]);
    }
    public function search(Request $request)
    {
        $request->validate([
            'search1' => 'required|string|max:255',
        ]);

        $searchQuery = $request->input('search1');
        session()->put('search', $searchQuery);
        $category_Childs = Category_Child::where('name_category_child', 'LIKE', "%$searchQuery%")->get();
        $products = [];

        foreach ($category_Childs as $categoryChild) {
            $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                ->where('product.id_category_child', $categoryChild->id)
                ->get();
        
            $products = array_merge($products, $product->toArray());
        }

        return view('client.product.product', [
            'products' => $products,        
        ]);
    }
    public function sort(Request $request)
    {
        $sortOrder = $request->input('sort');

        session()->put('sort', $sortOrder);
        if (session('id_category')) {            
            $categoryId = session('id_category');            
            $category_Childs = Category_Child::where('id_category', $categoryId)->get();
        } else {
            $searchQuery = session('search'); 
            $category_Childs = Category_Child::where('name_category_child', 'LIKE', "%$searchQuery%")->get();
        }
        
        $products = [];

        foreach ($category_Childs as $categoryChild) {
            $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                ->where('product.id_category_child', $categoryChild->id)
                ->get();

            $products = array_merge($products, $product->toArray());
        }

        // Sắp xếp theo giá sau khi đã merge hết
        if ($sortOrder == 'asc') {
            usort($products, function ($a, $b) {
                return $a['price'] <=> $b['price'];
            });
        } else {
            usort($products, function ($a, $b) {
                return $b['price'] <=> $a['price'];
            });
        }

        return view('client.product.product', [
            'products' => $products,
        ]);
    }
    public function priceFilter(Request $request)
    {
        // Validate the form input
        $request->validate([
            'price_from' => 'required|numeric|min:0',
            'price_arrives' => 'nullable|numeric|min:0',
        ]);
        if (session('id_category')) {            
            $categoryId = session('id_category');            
            $category_Childs = Category_Child::where('id_category', $categoryId)->get();
        } else {
            $searchQuery = session('search'); 
            $category_Childs = Category_Child::where('name_category_child', 'LIKE', "%$searchQuery%")->get();
        }
        $priceFrom = $request->input('price_from');
        $priceArrives = $request->input('price_arrives');

        session()->put('price_from', $priceFrom);
        session()->put('price_arrives', $priceArrives);
        // Kiểm tra nếu price_arrives là null
        if ($priceArrives === null) {
            $products = [];

            foreach ($category_Childs as $categoryChild) {
                $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                    ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                    ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                    ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                    ->where('product.id_category_child', $categoryChild->id)
                    ->where('product_detail.price', '>=', $priceFrom); // Điều kiện lọc theo giá từ priceFrom
                    
                    // Kiểm tra nếu có sắp xếp
                    if (session('sort')) {
                        // Thực hiện sắp xếp theo giá
                        if (session('sort') == 'asc') {
                            $product->orderBy('price');
                        } else {
                            $product->orderByDesc('price');
                        }
                    }

                    $product = $product->get();

                $products = array_merge($products, $product->toArray());
            }
        } else {
            // Xử lý khi price_arrives không phải là null
            $category_Childs = Category_Child::where('id_category', $categoryId)->get();
            $products = [];

            foreach ($category_Childs as $categoryChild) {
                $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                    ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                    ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                    ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                    ->where('product.id_category_child', $categoryChild->id)
                    ->whereBetween('product_detail.price', [$priceFrom, $priceArrives]);
                    
                    // Kiểm tra nếu có sắp xếp
                    if (session('sort')) {
                        // Thực hiện sắp xếp theo giá
                        if (session('sort') == 'asc') {
                            $product->orderBy('price');
                        } else {
                            $product->orderByDesc('price');
                        }
                    }

        $product = $product->get();

                $products = array_merge($products, $product->toArray());
            }
        }

        return view('client.product.product', [
            'price_from' => $priceFrom, 'price_arrives' => $priceArrives, 'products' => $products
        ]);
    }

}
