<!-- Page Header Start -->
@extends('client.layouts.app')
@section('title', 'SEASIDE STORE SHOP')
@section('content')



    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-102 cl5">
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">

                </div>

            </div>
            <div style="display: flex; width:100%">
                <form style="width: 20%; padding-right: 10px" action="{{ route('client.product.price') }}" method="post">
                    @csrf
                    <label for="priceRange">Khoảng giá:</label>
                    <div style="display: flex" class="m-b">
                        <input type="number" name="price_from" class="form-control" placeholder="Từ" id="price_from" min="0" step="1" required value="@if (session('price_from')){{ session('price_from') }}@endif">
                        <span style="margin-left: 10px; margin-right: 10px"> - </span>
                        <input type="number" name="price_arrives" class="form-control" placeholder="Đến" id="price_arrives" min="0" step="1" value="@if (session('price_arrives')){{ session('price_arrives') }}@endif">
                    </div>
                
                    <button type="submit" class="btn btn-primary m-b w-100">Áp dụng</button>
                </form>                          
                
                <div class="row" style="width: 80%">

                    <form style="width:100%; display: flex; margin-bottom: 10px;margin-left: 30px" action="{{ route('client.product.sort') }}" method="post">
                            @csrf
                            <label for="sort" style="margin-right: 10px">Sắp xếp:</label>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="asc" @if (request()->input('sort') == 'asc') selected @endif>Tăng dần</option>
                                <option value="desc" @if (request()->input('sort') == 'desc') selected @endif>Giảm dần</option>
                            </select>
                    </form>

                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block3-pic hov-img0">
                                    <img src="{{ $product['url_image'] }}" alt="IMG-PRODUCT">

                                    <a href="#"
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Quick View
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a style="height: 40px" href="product-detail.html"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ \Illuminate\Support\Str::limit($product['name_product'], 40, ' ...') }}
                                        </a>

                                        <span class="stext-105 cl3" style="color: #fa4251">
                                            {{ number_format($product['price'], 0, ',', '.') }} <span
                                                style="font-size: 14px">đ</span>
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
                                                alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="images/icons/icon-heart-02.png" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </section>
@endsection
