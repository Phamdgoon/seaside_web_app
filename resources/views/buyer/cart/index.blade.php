@extends('buyer.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')
    <section class="sec-product-detail bg12 p-t-65 p-b-60">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="w-full mtext-106 bg2"><p style="display: flex;color:#d52a2a"class="m-l-70" >Giỏ hàng</p></div>

        <div class="scrollable-table-container">
            <table class="scrollable-table">
                <thead>
                    <tr >
                        <th><input type="checkbox" class="cart-checkbox" data-cart-id="All"></th>
                        <th style="width: 600px">Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Số tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" class="cart-checkbox" data-cart-id="{{-- $cart->id --}}">
                        </td>
                        <td style="display: flex;color:#d52a2a">
                            <i class="fa-solid fa-shop p-r-10"></i>Thời trang nam Seaside
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="cart-checkbox" data-cart-id="All">
                        </td>
                        <td style="display: flex">
                            <img class="img-product-cart" src="images/product-08.jpg">
                            <span style=" overflow-wrap: break-word;width:300px">Áo khoác phao Nam 3 lớp chần ngang chống
                                thấm nước </span>
                            <span class="p-l-30">Phân loại: S</span>
                        </td>
                        <td id="price">120000</td>
                        <td>
                            <button class="quantity-btn" data-increment="-1">-</button>
                            <span class="quantity " id="quantity"></span>
                            <button class="quantity-btn" data-cart-id="" data-increment="1">+</button>
                        </td>
                        <td id="total-price">
                            120000 </td>
                        <td>
                            <button class="delete-btn" data-cart-id="">
                                <i class="fa-solid fa-delete-left" style="color: #d52a2a;"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="buy-container">
            <div class="buy-button-container">
                <span >
                    <i class="fa-solid fa-ticket p-r-10" style="color: red;"></i>SeaSide Voucher:
                </span>
                <button type="button" class="flex-c-m stext-103 cl1 size-101 p-lr-15 trans-04 fl-r">
                    Chọn hoặc nhập mã
                </button>
            </div>
            <div class="delete-product"> 
                <button><b>Chọn tất cả(10)</b></button>
                <button><b>Xóa</b></button>
            </div>
            <div class="buy-button-container">
                <span style="display: flex"><b>Tổng thanh toán(0 sản phẩm): </b>
                    <p id="Tong-tien"style="color: red"> 0 đ</p>
                </span>
                <button type="button" class="flex-c-m stext-103 cl0 size-101 bg10 bor3 hov-btn1 p-lr-15 trans-04 fl-r">
                    Mua hàng
                </button>
            </div>
        </div>
    </section>
@endsection
<script src="js/cart.js"></script>
