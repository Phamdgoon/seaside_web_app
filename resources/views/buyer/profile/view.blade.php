@extends('buyer.profile.index')
<style>
    .form fieldset {
        margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        display: flex;
        margin-left: 50px;
        margin-right: 50px;
        justify-content: space-between;
    }

    fieldset legend {
        font-size: 18px;
        color: #333;
        display: flex;
        justify-content: space-between;
    }

    fieldset div {
        display: flex;
    }

    fieldset div div {
        display: block;
    }

    fieldset div img {
        height: 120px;
        width: 120px;
    }

    fieldset label {
        display: flex;
        margin-bottom: 5px;
    }
</style>
@section('content1')
    @if (session('ok'))
        <div class="alert alert-success" id="success-alert">
            {{ session('ok') }}
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <div class="profile-container">
        <h4>Tất cả đơn hàng</h4>
        <div class="separator"></div>
        <div class="form">
            @foreach ($orderDetails as $orderDetail)
                <fieldset>
                    <legend><b>{{ \Illuminate\Support\Str::limit($orderDetail->name_product, 60, ' ...') }}</b>
                        <p>{{ $orderDetail->status }}</p>
                    </legend>
                    <div>
                        <img src="{{ $orderDetail->url_image }}" alt="">
                        <div>
                            <p style="width: 250px">Kiểu: {{ $orderDetail->name_product_detail }}</p>
                            <p>Size: {{ $orderDetail->size }}</p>
                            <p>Giá: {{ number_format($orderDetail->productPrice, 0, ',', ',') }}</p>
                            <p>Số lượng: {{ $orderDetail->quantity }}</p>
                        </div>
                    </div>
                    <div style="display: block;width:250px">
                        <p>Thành tiền: <span
                                style="color: crimson;font-size: 20px">{{ number_format($orderDetail->price, 0, ',', ',') }}
                                đ</span></p>
                        <p style="margin-top: 10px">( {{ $orderDetail->payment_methods }} )</p>
                    </div>
                    <div style="width:220px">
                        @if ($orderDetail->status == 'Đã giao hàng')
                            <div>
                                <form method="POST" action="{{ route('confirm.received', $orderDetail->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex-c-m stext-101 cl0 bg10 bor1 hov-btn1 p-lr-15 trans-04">
                                        Xác nhận nhận hàng
                                    </button>
                                </form>
                            </div>
                        @else
                            @if ($orderDetail->status == 'Đã nhận hàng')
                                <div>
                                    <a href="{{ route('buyer.productDetail', ['id' => $orderDetail->idProduct]) }}"
                                        class="flex-c-m stext-101 cl0  bg10 bor1 hov-btn1 p-lr-15 trans-04">
                                        Mua lại
                                    </a>
                                </div>
                            @else
                                <div>
                                    <label>
                                        {{ $orderDetail->status }}
                                    </label>
                                </div>
                            @endif
                        @endif
                    </div>
                </fieldset>
            @endforeach
        </div>
    </div>
@endsection
