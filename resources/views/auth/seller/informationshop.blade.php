<!-- resources/views/create_shop.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bạn có thể thay đổi đường dẫn của Bootstrap nếu cần -->
    <style>
        /* Thêm CSS để điều chỉnh kích thước của hình ảnh xem trước */
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    @if (session('username'))
        @php
            $user = \App\Models\User::where('username', session('username'))->first();
        @endphp
        <div class="info">
            <h6>{{ $user->username }}</h6>
        </div>
    @endif
    <a href="{{ route('logout') }}">đăng xuất</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Shop</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shop.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name_shop">Shop Name:</label>
                            <input type="text" name="name_shop" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cover_image">Cover Image:</label>
                            <input type="file" name="cover_image" class="form-control-file" onchange="previewImage(this, 'cover_image_preview')">
                            <img id="cover_image_preview" class="preview-image" src="" alt="Preview">
                        </div>

                        <div class="form-group">
                            <label for="avt">Avatar:</label>
                            <input type="file" name="avt" class="form-control-file" onchange="previewImage(this, 'avt_preview')">
                            <img id="avt_preview" class="preview-image" src="" alt="Preview">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Shop</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>

</body>
</html>
