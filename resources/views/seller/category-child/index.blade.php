@extends('seller.layouts.app')
@section('title', 'Quản lý danh mục')
@section('content')
<a href="/seller1/categories-child/create" class="btn btn-success mb-3">Thêm danh mục</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Danh mục cha</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories_child as $category_child)
        <tr>
            <td>{{ $category_child->id }}</td>
            <td>{{ $category_child->name_category_child }}</td>
            <td>{{ $category_child->category->name_category }}</td>
            <td>
                <a href="/seller1/categories-child/update/{{ $category_child->id }}" class="btn btn-warning">Edit</a>
                <button class="btn btn-delete btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories_child->links() }}
@endsection