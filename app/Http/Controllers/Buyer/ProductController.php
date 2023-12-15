<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Images;
use App\Models\Category_Child;
use App\Models\Size_Product;
use App\Models\Feedback;
use App\Models\Feedback_Images;
use App\Models\ShopProfile;

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
        
        return view('buyer.product.product', [
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

        return view('buyer.product.product', [
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
                ->where('product.id_category_child', $categoryChild->id);
        
            if (session('price_from')) {
                if (session('price_arrives')) {
                    $product->whereBetween('product_detail.price', [session('price_from'), session('price_arrives')]);
                } else {
                    $product->where('product_detail.price', '>=', session('price_from'));
                }
            }
        
            $product = $product->get();
            $products = array_merge($products, $product->toArray());
        }        

        if ($sortOrder == 'asc') {
            usort($products, function ($a, $b) {
                return $a['price'] <=> $b['price'];
            });
        } else {
            usort($products, function ($a, $b) {
                return $b['price'] <=> $a['price'];
            });
        }

        return view('buyer.product.product', [
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
        $products = [];

            foreach ($category_Childs as $categoryChild) {
                $product = Product::select('product.id', 'product.name_product', 'product.id_category_child', DB::raw('MIN(product_detail.price) as price'), DB::raw('MAX(product_image.url_image) as url_image'))
                    ->leftJoin('product_detail', 'product.id', '=', 'product_detail.id_product')
                    ->leftJoin('product_image', 'product_detail.id', '=', 'product_image.id_product_detail')
                    ->groupBy('product.id', 'product.name_product', 'product.id_category_child')
                    ->where('product.id_category_child', $categoryChild->id);
                    if ($priceArrives === null) {
                            $product->where('product_detail.price', '>=', $priceFrom);
                        } else {
                            $product->whereBetween('product_detail.price', [$priceFrom, $priceArrives]);
                        }
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
        
        return view('buyer.product.product', [
            'price_from' => $priceFrom, 'price_arrives' => $priceArrives, 'products' => $products
        ]);
    }

    public function productDetail(Request $request)
    {
        $id = $request->input('id');
        $products = Product::find($id);
        $priceByProduct = [];
        $product_Details = Product_Detail::where('id_product', $id)->get();
        $priceStats = Product_Detail::where('id_product', $id)
            ->selectRaw('MIN(price) as minPrice, MAX(price) as maxPrice')
            ->first();

        $minPrice = $priceStats->minPrice;
        $maxPrice = $priceStats->maxPrice;

        $priceByProduct[$id] = [
            'min' => $minPrice,
            'max' => $maxPrice,
        ];
        foreach($product_Details as $product_Detail){

            $size_Product = Size_Product::where('id_product_detail', $product_Detail->id)->get();
            $product_Images = Product_Images::whereIn('id_product_detail', $product_Details->pluck('id'))->get();
        }
        $shopProfile=ShopProfile::where('name_shop',$products->name_shop)->get();

        $productNumber = ShopProfile::join('product', 'shop_profile.name_shop', '=', 'product.name_shop')
        ->where('shop_profile.name_shop', $products->name_shop)
        ->count('shop_profile.name_shop');    

        $feedbackNumber = Feedback::join('order_detail', 'order_detail.id', '=', 'feedback.id_order_detail')
        ->join('product_detail', 'product_detail.id', '=', 'order_detail.id_product_detail')
        ->join('product', 'product.id', '=', 'product_detail.id_product')
        ->join('shop_profile', 'shop_profile.name_shop', '=', 'product.name_shop')
        ->where('shop_profile.name_shop', $products->name_shop)
        ->count('feedback.id');

        $feedbackDatas = Feedback::join('order_detail', 'order_detail.id', '=', 'feedback.id_order_detail')
        ->join('order', 'order.id', '=', 'order_detail.id_order')
        ->join('product_detail', 'product_detail.id', '=', 'order_detail.id_product_detail')
        ->join('product', 'product.id', '=', 'product_detail.id_product')
        ->join('buyer_profile', 'buyer_profile.username', '=', 'order.username')
        ->where('product.id', $id)
        ->select('feedback.id', 'buyer_profile.account_name', 'buyer_profile.avt', 'feedback.created_at', 'feedback.star', 'product_detail.name_product_detail', 'order_detail.size', 'feedback.message')
        ->get();
        $feedback_Images=0;
        foreach($feedbackDatas as $feedbackData){
            $feedback_Images= Feedback_Images::where('id_feedback',$feedbackData->id)->get();
        }
        // Count total feedback
        $totalFeedback = $feedbackDatas->count();

        // Calculate average star rating
        $averageStarRating = $feedbackDatas->avg('star');

        // foreach ($product_Details as $product_Detail) {
        //     $size_Product = Size_Product::where('id_product_detail', $product_Detail->id)->get();
        // }

        $request->session()->put('shopProfile', [
            'productNumber' => $productNumber,
            'feedbackNumber' => $feedbackNumber,
        ]);

        return view('buyer.product.productDetail', [
            'ID' => $id,
            'products' => $products,
            'priceByProduct' => $priceByProduct,
            'productDetailsWithImages' => $product_Images,
            'size_Product' => $size_Product,
            'product_Details' => $product_Details,
            'feedbackData' => $feedbackDatas,
            'totalFeedback' => $totalFeedback,
            'averageStarRating' => $averageStarRating,
            'feedback_Images' => $feedback_Images,
            'shopProfiles' =>$shopProfile,
        ]);
    }
}
