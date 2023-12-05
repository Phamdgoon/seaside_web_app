<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Kênh người bán
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Đăng ký thành người bán
                    </a>
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        <i class="fa-solid fa-circle-question"></i>
                        Hỗ trợ
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        <i class="fa-solid fa-bell"></i>
                        Thông báo
                    </a>
                </div>
            </div>
        </div>
        {{-- Modal đăng xuất --}}
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn muốn đăng xuất ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Chọn "Đăng xuất" nếu bạn chắc chắn.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <a class="btn btn-primary" href="#">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('client.home') }}" class="logo" style="color: #000">
                    <h4><b>SEASIDE</b> STORE</h4>
                </a>



                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <form action="{{ route('client.product.search') }}" method="post">
                        @csrf
                        <div class="input-wrapper flex-w">
                            <input type="text" name="search1" placeholder="Tìm kiếm..." value="@if (session('search')){{ session('search') }}@endif" class="search-input">
                            <button type="submit" class="icon-search zmdi zmdi-search"></button>
                        </div>
                    </form>
                    
                    
                    <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                        data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                    <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                        data-notify="5">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                    {{-- <a href="{{ route('client.cart.index') }}"
                    class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                    data-notify="@if (session('countCart')) {{ session('countCart') }}
                @else
                    0 @endif">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </a> --}}
                </div>


                @if (session('username'))
                    @php
                        $user = \App\Models\User::where('username', session('username'))->first();
                    @endphp
                    <div class="nav-item dropdown">
                        <a href="#" style="height: 100%;color: #bf6d72;" class="nav-link dropdown-toggle"
                            onclick="toggleDropdown()" data-bs-toggle="dropdown">
                            <img src="{{ $user->avt }}" alt="" class="rounded-circle"
                                style=" width: 50px;height: 50px;">
                            {{ $user->account_name }}
                        </a>
                        <div id="userDropdown" class="dropdown-menu">
                            <a href="#" class="dropdown-item"><i class="fa-solid fa-user"></i> Thông
                                tin cá nhân</a>
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                        </div>
                    </div>
                @else
                    <a style="margin-left: 20px;color: inherit;" href="#">Đăng nhập</a>
                @endif

            </nav>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </div>
</header>

<script src="js/dropdown_header.js"></script>
