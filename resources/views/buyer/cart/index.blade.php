@extends('buyer.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')
    <section class="sec-product-detail bg12 p-t-65 p-b-60">
        <style>
            .scrollable-table-container {
                width: 90%;
                margin-left: 5%;
                height: 70vh;
                /* Set the container height to 80% of the viewport height */
                overflow-y: auto;
                /* Enable vertical scrollbar if the content overflows */
            }

            /* Optional: You can style your table further if needed */
            .scrollable-table {
                width: 100%;
                /* Set the table width to 100% */
                border-collapse: collapse;
                /* Optional: Remove spacing between table cells */
                /* Add other styling as needed */
            }
        </style>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <nav>
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="{{ route('buyer.home') }}">
                        <p>Trang chủ</p>
                    </a></li>
                <li class="breadcrumb-item " aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
        <div class="scrollable-table-container">
            @if (count($carts) > 0)
                <table class="scrollable-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="cart-checkbox" data-cart-id="All"></th>
                            <th>ID</th>
                            <th style="width: 400px">Sản phẩm</th>
                            <th>Kiểu sản phẩm</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cart-checkbox" data-cart-id="{{ $cart->id }}">
                                </td>
                                <td>{{ $count++ }}</td>
                                <td style="display: flex">
                                    <img src="{{ $cart->url_image }}" alt="Product Image" width="50">
                                    <b>{{ \Illuminate\Support\Str::limit($cart->name_product, 60, ' ...') }}</b>
                                </td>
                                <td>{{ $cart->name_product_detail }}</td>
                                <td>{{ $cart->size }}</td>
                                <td id="price-{{ $cart->id }}">{{ number_format($cart->price, 0, ',', ',') }}</td>
                                <td>
                                    <button class="quantity-btn" data-cart-id="{{ $cart->id }}"
                                        data-increment="-1">-</button>
                                    <span class="quantity " id="quantity-{{ $cart->id }}">{{ $cart->quantity }}</span>
                                    <button class="quantity-btn" data-cart-id="{{ $cart->id }}"
                                        data-increment="1">+</button>
                                </td>
                                <td id="total-price-{{ $cart->id }}">
                                    {{ number_format($cart->price * $cart->quantity, 0, ',', ',') }}</td>
                                <td>
                                    <button class="delete-btn" data-cart-id="{{ $cart->id }}"><i
                                            class="fa-solid fa-delete-left" style="color: #ff0000;"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Giỏ hàng của bạn đang trống.</p>
            @endif
        </div>
        <div class="buy-button-container">
            <span style="display: flex;color: red"><b>Tổng tiền: </b>
                <p id="Tong-tien"> </p>đ
            </span>
            <button type="button" class="flex-c-m stext-101 cl0 size-101 bg1 bor3 hov-btn1 p-lr-15 trans-04 fl-r"
                onclick="buySelected()">
                Mua ngay
            </button>
        </div>
    </section>
@endsection
<script src="js/cart.js"></script>
