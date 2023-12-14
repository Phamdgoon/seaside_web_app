@extends('client.layouts.app')
@section('title', 'SEASIDE STORE SHOP')
@section('content')
<section class="bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="px-4 pt-0 pb-4 cover" style="background-image: url('https://vcdn-dulich.vnecdn.net/2021/12/24/An-Giang-0-jpeg-1470-1640315739.jpg');">
            <div class="media align-items-end profile-head">
                <div class="profile mr-3"><img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                    <a href="#" class="btn btn-outline-dark btn-sm btn-block">Theo dõi</a>
                </div>
                <div class="media-body mb-5 text-white">
                    <h4 class="mt-0 mb-0">Mark Williams</h4>
                    <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p>
                </div>
            </div>
        </div>
        <div class="bg-light p-4 d-flex justify-content-end text-center">
            <ul class="list-inline mb-0">
                <li class="list-inline-item" style="margin-left: 50px" ;>
                    <h5 class="font-weight-bold mb-0 d-block">215</h5>
                    <small class="text"> <i class="fas fa-box-open mr-1"></i>Sản phẩm</small>
                </li>
                <li class="list-inline-item" style="margin-left: 50px" ;>
                    <h5 class="font-weight-bold mb-0 d-block">745</h5>
                    <small class="text"> <i class="fas fa-star mr-1"></i>Đánh giá</small>
                </li>
                <li class="list-inline-item" style="margin-left: 50px" ;>
                    <h5 class="font-weight-bold mb-0 d-block">340</h5>
                    <small class="text"> <i class="fas fa-clock mr-1"></i>Tham gia</small>
                </li>
            </ul>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Tất cả sản phẩm
                </button>
                @foreach ($category_childs as $category_child)
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $category_child->id }}">
                    {{ $category_child->name_category_child }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="row isotope-grid">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->id_category_child}}">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ $product->url_image }}" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Quick View
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a style="height: 40px" href="product-detail.html"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ \Illuminate\Support\Str::limit($product->name_product, 60, ' ...') }}
                                    </a>

                                    <span class="stext-105 cl3" style="color: #fa4251">
                                        {{ number_format($product->price, 0, ',', '.') }} <span
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
</section>
@endsection