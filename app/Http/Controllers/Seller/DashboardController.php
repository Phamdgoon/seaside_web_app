<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order_Detail;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopProfile');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopId = $request->idShop;
        $shopProfile = ShopProfile::find($shopId);

        if ($shopProfile) {
            $productCount = $shopProfile->products()->count();

            $orderDetailCount = 0;
            foreach ($shopProfile->products as $product) {
                foreach ($product->productDetails as $productDetail) {
                    $orderDetailCount += $productDetail->orderDetails->count();
                }
            }

            $revenue = 0;
            foreach ($shopProfile->products as $product) {
                foreach ($product->productDetails as $productDetail) {
                    $revenue += $productDetail->orderDetails
                        ->where('status', trim(strtolower('Đã nhận hàng')))
                        ->sum('price');
                }
            }

            return view('seller.dashboard.index', compact('productCount', 'orderDetailCount', 'revenue'));
        } else {
            return response()->json(['error' => 'Shop not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
