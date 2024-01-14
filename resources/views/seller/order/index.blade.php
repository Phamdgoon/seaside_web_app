@extends('seller.layouts.app')
@section('title', 'Danh sách đơn hàng')
@section('content')
<section id="tabs" class="project-tab">
    <div class="row">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Tất cả</a>
                    <a class="nav-item nav-link" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false">Chờ xác nhận</a>
                    <a class="nav-item nav-link" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Chờ lấy hàng</a>
                    <a class="nav-item nav-link" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Chờ giao hàng</a>
                    <a class="nav-item nav-link" id="nav-complete-tab" data-toggle="tab" href="#nav-complete" role="tab" aria-controls="nav-complete" aria-selected="false">Hoàn thành</a>
                    <a class="nav-item nav-link" id="nav-cancelled-tab" data-toggle="tab" href="#nav-cancelled" role="tab" aria-controls="nav-cancelled" aria-selected="false">Đã hủy</a>
                    <a class="nav-item nav-link" id="nav-returned-tab" data-toggle="tab" href="#nav-returned" role="tab" aria-controls="nav-returned" aria-selected="false">Trả hàng/Hoàn tiền</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetailsList as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->id }}</td>
                                <td>{{ $orderDetail->order->user->username }}</td>
                                <td>{{ $orderDetail->productDetail->product->name_product }}</td>
                                <td>{{ $orderDetail->quantity }}, {{ $orderDetail->size }}, {{ $orderDetail->productDetail->name_product_detail}}</td>
                                <td>{{ number_format($orderDetail->price, 2, ',', '.') }}</td>
                                <td>{{ $orderDetail->order->payment_methods }}</td>
                                <td>
                                    <a href="/seller1/vouchers/update/{{ $orderDetail->id }}" class="btn btn-warning"><i class="nav-icon fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="nav-complete" role="tabpanel" aria-labelledby="nav-complete-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetailsList as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->id }}</td>
                                <td>{{ $orderDetail->order->user->username }}</td>
                                <td>{{ $orderDetail->productDetail->product->name_product }}</td>
                                <td>{{ $orderDetail->quantity }}, {{ $orderDetail->size }}</td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection