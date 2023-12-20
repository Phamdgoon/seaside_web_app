@extends('seller.layouts.app')
@section('title', 'Quản lý danh mục')
@section('content')
<button id="add_form" class="btn btn-success mb-3">Thêm danh mục</button>
<!-- hidden -->
<div id="add_form_info" class="modal">
    <form action="" method="POST">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-center">
                    <b class="modal-title text-center">Thêm danh mục</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name_category_child" class="form-control" placeholder="Nhập tên danh mục" value="{{ old('name_category_child') }}">
                        @error('name_category_child')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Danh mục cha <span class="text-danger"> *</span></label>
                        <select class="form-control" name="id_category">
                            @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->name_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        @csrf
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

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
        @foreach ($categories_child as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name_category_child }}</td>
            <td>{{ $category->category->name_category }}</td>
            <td>
                <a href="" class="btn btn-warning">Edit</a>
                <button class="btn btn-delete btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories_child->links() }}
<script>
    document.getElementById('add_form').addEventListener('click', function() {
        var myModal = new bootstrap.Modal(document.getElementById('add_form_info'));
        myModal.show();
    });
</script>
@endsection