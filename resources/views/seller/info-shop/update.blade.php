@extends('seller.layouts.app')
@section('title', 'Cập nhật thông tin shop')
@section('content')
<div class="row">
    <div class="col-md-4">
        <b>Thông tin shop</b>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <p>Tên shop</p>
    </div>
    <div class="col-md-8">
        <input type="text" name="name_category_child" class="form-control" placeholder="Nhập tên danh mục" value="{{ $categories_child->name_category_child }}">
        @error('name_category_child')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <p>Địa chỉ</p>
    </div>
    <div class="col-md-8">
        <p>{{ $shopProfiles->address}}</p>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <p>Ảnh đại diện</p>
    </div>
    <div class="col-md-8">
        <img src="{{ $shopProfiles->avt}}" style="width: 100px; height: 100px">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <p>Ảnh bìa</p>
    </div>
    <div class="col-md-8">
        <img src="{{ $shopProfiles->cover_image}}" style="width: 200px; height: 100px">
    </div>
</div>
@endsection