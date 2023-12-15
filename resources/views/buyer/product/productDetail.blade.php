<!-- Page Header Start -->
@extends('buyer.layouts.app')
@section('title', $products->name_product)
@section('content')

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">

        <!-- breadcrumb -->
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-b-30 p-lr-0-lg">
                <a href="{{ route('buyer.home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                    Home
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    {{ $products->name_product }}
                </span>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach ($productDetailsWithImages as $product_Image)
                                    <div class="item-slick3" data-thumb="{{ asset($product_Image->url_image) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img class="" src="{{ asset($product_Image->url_image) }}"
                                                alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset($product_Image->url_image) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                            {{-- <h4>{{ $productDetailWithImages['productDetail']->color }}</h4>
                                                <p style="color: #ff2600">Giá
                                                    :{{ number_format($productDetailWithImages['productDetail']->price, 0, ',', '.') }}
                                                    đ
                                                </p> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 p-b-14">
                            @if (session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        $('#success-alert').fadeOut('fast');
                                    }, 3000);
                                </script>
                            @endif
                            <span class="js-name-detail">{{ $products->name_product }}</span><br>
                            <p style="color: #f9ba48">
                                {{ number_format($averageStarRating, 1) }}
                                @if ($averageStarRating > floor($averageStarRating))
                                    @for ($i = 0; $i < floor($averageStarRating); $i++)
                                        <i class="zmdi zmdi-star"></i>
                                    @endfor
                                    <i class="zmdi zmdi-star-half"></i>
                                @else
                                    @for ($i = 0; $i < $averageStarRating; $i++)
                                        <i class="zmdi zmdi-star"></i>
                                    @endfor
                                @endif
                                <span style="color: black">| {{ $totalFeedback }}</span><span style="color: #888"> Đánh
                                    giá</span>
                            </p>
                        </h4>

                        <span style="color: #ff2600;font-size: 24px" class="mtext-106 cl2">
                            @if ($priceByProduct[$ID]['min'] == $priceByProduct[$ID]['max'])
                                Giá : {{ number_format($priceByProduct[$ID]['min'], 0, ',', '.') }} <span
                                    style="font-size: 18px">đ</span>
                            @else
                                Giá : {{ number_format($priceByProduct[$ID]['min'], 0, ',', '.') }} -
                                {{ number_format($priceByProduct[$ID]['max'], 0, ',', '.') }} <u>đ</u>
                            @endif
                        </span>
                        <p class="stext-102 cl3 p-t-23">
                            {{ $products->description }}
                        </p>

                        <!--  -->
                        {{-- {{ route('cart.add') }} --}}
                        <form action="#" method="post" id="productForm">
                            @csrf
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="size">
                                                @foreach ($size_Product as $sizeProduct)
                                                    <option>{{ $sizeProduct->size }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="color">
                                                @foreach ($product_Details as $product_Detail)
                                                    <option value="{{ $product_Detail->id }}">
                                                        {{ $product_Detail->name_product_detail }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">

                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="quantity" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="group-cart">
                                        <button type="submit" name="action" value="add_to_cart"
                                            class="flex-c-m stext-101 cl0 size-101 bg10 bor1 hov-btn1 p-lr-15 trans-04">
                                            Giỏ hàng
                                        </button>
                                        <button type="button" onclick="submitForm('buy_now')"
                                            class="flex-c-m stext-101 cl0 size-101 bg10 bor1 hov-btn1 p-lr-15 trans-04">
                                            Mua ngay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- <script>
                            function submitForm(action) {
                                var form = document.getElementById('productForm');
                                form.action = action === 'buy_now' ? "{{ route('client.order.processOrder') }}" : "{{ route('cart.add') }}";
                                form.submit();
                            }
                        </script> --}}

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <!-- Facebook Share -->
                            <a href="" class="fs-14 cl13 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="shareOnFacebook()" data-tooltip="Chia sẻ trên Facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </a>

                            <!-- Twitter Share -->
                            <a href="" class="fs-14 cl15 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="shareOnTwitter()" data-tooltip="Chia sẻ trên Twitter">
                                <i class="fa-brands fa-square-twitter"></i>
                            </a>

                            <!-- Google Plus Share -->
                            <a href="" class="fs-14 cl14 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="shareOnGooglePlus()" data-tooltip="Chia sẻ trên Google Plus">
                                <i class="fa-brands fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($shopProfiles as $profile)
                <div class="container">
                    <div class="row bg2">
                        <div>
                            <a href="#" style="height: 100%; color: #bf6d72;" class="nav-link">
                                <div class="small-avatar-container">
                                    <img name="avt" src="{{ $profile->avt }}" alt="Avatar của Shop"
                                        class="rounded-circle small-avatar-shop">
                                </div>
                            </a>
                        </div>
                        <div class="p-t-10">
                            <h5 name="name_shop">{{$profile->name_shop}}</h5>
                            <div class=" p-t-10 button-container">
                                <div>
                                    <button class="flex-c-m stext-102 cl14 bg11 bor10 hov-btn3 p-lr-15 p-tb-3 trans-04">
                                        <i class="fas fa-comment-dots p-r-3"></i>Chat ngay
                                    </button>
                                </div>
                                <div class="m-l-10">
                                    <button class="flex-c-m stext-102 cl8 bg0 bor20 hov-btn3 p-lr-15 p-tb-3 trans-04">
                                        <i class="fas fa-store p-r-3"></i>Xem shop
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-tb-15 p-lr-40 flex-w">
                            @php
                            $productNumber = session('shopProfile')['productNumber'];
                            $feedbackNumber = session('shopProfile')['feedbackNumber'];
                             @endphp
                            <div>
                                <div class="flex-shop">
                                    <label>Đánh giá </label>
                                    <span class="p-l-20 cl14 txt-right">{{ $feedbackNumber }}</span>
                                </div>
                                <div class="flex-shop">
                                    <label>Sản phẩm</label>
                                    <span class="p-l-20 cl14 txt-right">{{ $productNumber }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-tb-15 p-lr-40 ">
                            <div>
                                <div class="flex-shop">
                                    <label>Đánh giá </label>
                                    <span class="p-l-20 cl14 txt-right">20k</span>
                                </div>
                                <div class="flex-shop">
                                    <label>Sản phẩm</label>
                                    <span class="p-l-20 cl14 txt-right">123</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-tb-15 p-lr-40 ">
                            <div>
                                <div class="flex-shop">
                                    <label>Đánh giá </label>
                                    <span class="p-l-20 cl14 txt-right">20k</span>
                                </div>
                                <div class="flex-shop">
                                    <label>Sản phẩm</label>
                                    <span class="p-l-20 cl14 txt-right">123</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="bor22 m-t-50 p-t-43 p-b-40">
                @foreach ($feedbackData as $feedback)
                    <div class="flex-w flex-t p-b-10 m-l-20">
                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                            <img src="{{ $feedback->avt }}" alt="AVATAR">
                        </div>

                        <div class="size-207">
                            <div>
                                {{ $feedback->account_name }}
                                <span class="fs-18 cl11">
                                    @for ($i = 0; $i < $feedback->star; $i++)
                                        <i class="zmdi zmdi-star"></i>
                                    @endfor
                                </span>
                            </div>
                            <p>
                                {{ $feedback->created_at }} | {{ $feedback->name_product_detail }} |
                                Size:{{ $feedback->size }}
                            </p>

                            <p class="stext-102 cl6">
                                {{ $feedback->message }}
                            </p>
                            <div class="block2-pic" style="display: flex;height:200px">
                                @foreach ($feedback_Images as $feedback_Image)
                                    <img class="img-feedback" src="{{ $feedback_Image->url_image }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endsection
