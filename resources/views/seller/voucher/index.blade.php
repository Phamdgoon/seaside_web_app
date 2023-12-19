@extends('seller.layouts.app')
@section('title', 'Danh sách mã giảm giá')
@section('content')
<a href="" class="btn btn-success mb-3">Thêm mã giảm</a>
<section id="tabs" class="project-tab">
    <div class="row">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Tất cả</a>
                    <a class="nav-item nav-link" id="nav-happening-tab" data-toggle="tab" href="#nav-happening" role="tab" aria-controls="nav-happening" aria-selected="false">Đang diễn ra</a>
                    <a class="nav-item nav-link" id="nav-upcoming-tab" data-toggle="tab" href="#nav-upcoming" role="tab" aria-controls="nav-upcoming" aria-selected="false">Sắp diễn ra</a>
                    <a class="nav-item nav-link" id="nav-finished-tab" data-toggle="tab" href="#nav-finished" role="tab" aria-controls="nav-finished" aria-selected="false">Đã kết thúc</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Số % giảm</th>
                                <th>Số tiền giảm</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Số lượng</th>
                                <th>Đã dùng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ $voucher->discountPercentage }}</td>
                                <td>{{ $voucher->discountAmount }}</td>
                                <td>{{ $voucher->validFrom }}</td>
                                <td>{{ $voucher->validTo }}</td>
                                <td>{{ $voucher->usageLimit }}</td>
                                <td>{{ $voucher->discountPercentage }}</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-delete btn-danger">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-happening" role="tabpanel" aria-labelledby="nav-happening-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Số % giảm</th>
                                <th>Số tiền giảm</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Số lượng</th>
                                <th>Đã dùng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">Work 1</a></td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-upcoming" role="tabpanel" aria-labelledby="nav-upcoming-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Số % giảm</th>
                                <th>Số tiền giảm</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Số lượng</th>
                                <th>Đã dùng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">Work 1</a></td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-finished" role="tabpanel" aria-labelledby="nav-upcoming-tab">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Số % giảm</th>
                                <th>Số tiền giảm</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Số lượng</th>
                                <th>Đã dùng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">ff 1</a></td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection