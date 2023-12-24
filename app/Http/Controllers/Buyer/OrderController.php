<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Product;
use App\Models\Product_Images;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\ShippingAddress;

class OrderController extends Controller
{
    public function ProcessOrder(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (session()->has('username')) {
            $username = session('username');
            $shippingAddres=ShippingAddress::WHERE('username',$username)->get();
            // Lấy dữ liệu từ request
            $size = $request->input('size');
            $quantity = $request->input('quantity');
            $user = User::where('username', $username)->first();
            $selectedColorId = $request->input('color');
            $productDetail = Product_Detail::find($selectedColorId);

            $productId = $productDetail->id_product;

            $product = Product::find($productId);
            $product_Images = Product_Images::where('id_product_detail', $selectedColorId)->get();

                // Truyền dữ liệu đến view mà không lưu vào cơ sở dữ liệu
                return view('buyer.order.orderProduct', [
                    'user' => $user,
                    'productDetail' => $productDetail,
                    'product' => $product,  // Pass the product to the view
                    'size' => $size,
                    'quantity' => $quantity,
                    'product_Images' => $product_Images,
                    'shippingAddres' => $shippingAddres,
                ]);
        } else {
            // Handle the case when the product detail is not found
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    }

    public function SaveOrder(Request $request) {
        $username = session('username');
        $productDetail = Product_Detail::find($request->input('color'));
        $quantity = $request->input('quantity');
        $size = $request->input('size');

        $order = new Order();
        $order->username = $username; 
        $order->id_shipping_address = '1'; 
        $order->payment_methods = 'Thanh toán khi nhận hàng'; 
        $order->save();

        // Tạo một chi tiết đơn hàng mới
        $orderDetail = new Order_Detail();
        $orderDetail->id_order = $order->id; 
        $orderDetail->id_product_detail = $productDetail->id;
        $orderDetail->quantity = $quantity;
        $orderDetail->size = $size;
        $orderDetail->price = $productDetail->price * $quantity + 20000; 
        $orderDetail->status = 'Chờ duyệt'; 
        $orderDetail->save();

        return redirect()->route('view')->with('ok', 'Đã đặt hàng thành công');

    }

    public function saveOrderOnline(Request $request) {
        // Lấy các tham số trả về từ VNPAY
    $vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';

    // Kiểm tra xem thanh toán có bị hủy hay không
    if ($vnp_ResponseCode === '24') {
        // Thực hiện các xử lý khi thanh toán bị hủy
        echo "Thanh toán bị hủy. Xử lý tại đây.";
        return redirect()->route('client.home');
    } else {
        // Thực hiện các xử lý khác nếu cần
        $username = session('username');
        $quantity = $request->input('quantity');
        $size = $request->input('size');
        $vnp_Amount=$request->input('vnp_Amount');
        $idProductDetail = $request->input('idProductDetail');    
        
        $order = new Order();
        $order->username = $username; 
        $order->id_shipping_address = '1'; 
        $order->payment_methods = 'Đã thanh toán'; 
        $order->save();

        // Tạo một chi tiết đơn hàng mới
        $orderDetail = new Order_Detail();
        $orderDetail->id_order = $order->id; 
        $orderDetail->id_product_detail = $idProductDetail;
        $orderDetail->quantity = $quantity;
        $orderDetail->size = $size;
        $orderDetail->price = $vnp_Amount/100; 
        $orderDetail->status = 'Chờ duyệt'; 
        $orderDetail->save();
        return redirect()->route('view')->with('ok', 'Đã đặt hàng thành công');
    }

    }
    
}