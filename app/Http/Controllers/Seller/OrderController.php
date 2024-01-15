<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order_Detail;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $shopProfiles = $request->shopProfile;
        $orderDetailsList = [];

        foreach ($shopProfiles->products as $product) {
            foreach ($product->productDetails as $productDetail) {
                $orderDetailsList = array_merge($orderDetailsList, $productDetail->orderDetails->all());
            }
        }


        return view('seller.order.index', compact('orderDetailsList'));
    }

    public function confirm($id)
    {
        $orderDetail = Order_Detail::find($id);
        $orderDetail->update(['status' => 'Chờ lấy hàng']);

        return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận thành công.');
    }

    public function pickup($id)
    {
        $orderDetail = Order_Detail::find($id);
        $orderDetail->update(['status' => 'Đang giao hàng']);

        return redirect()->back()->with('success', 'Đơn hàng đã được lấy hàng thành công.');
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
