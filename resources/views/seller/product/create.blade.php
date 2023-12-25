@extends('seller.layouts.app')
@section('title', 'Thêm sản phẩm')
<style>
    /* Add this CSS to your stylesheet */
#productForm {
    max-width: 600px;
    margin: 0 auto;
}

.product-detail,
.product-size,
.product-image {
    margin-bottom: 15px;
}

.product-sizes-container,
.product-images-container {
    margin-left: 20px;
}

button {
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

/* Optional: Style form labels for better readability */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Optional: Add some spacing between sections */
#productSizesContainer,
#productDetailsContainer {
    margin-top: 20px;
}

</style>
@section('content')
    <div class="mb-3">
        <i class="fas fa-angle-left"></i>
        <a href="/seller/product" class="text-dark">Danh sách sản phẩm</a>
    </div>
    <h1>Add Product</h1>

    <form method="POST" action="{{ route('products.store') }}" id="productForm" enctype="multipart/form-data">
        @csrf

        <!-- Product Information -->
        <label for="name_product">Product Name:</label>
        <input type="text" name="name_product" required>

        <label for="id_category_child">Category:</label>
        <select name="id_category_child" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name_category_child }}</option>
            @endforeach
        </select>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <!-- Product Details -->
        <div id="productDetailsContainer">
            <div class="product-detail">
                <label>Product Detail:</label>
                <input type="text" name="product_details[0][name_product_detail]" required>

                <label>Price:</label>
                <input type="text" name="product_details[0][price]" required>

                <!-- Product Sizes for the first Product Detail -->
                <div class="product-sizes-container">
                    <div class="product-size">
                        <label>Size:</label>
                        <input type="text" name="product_details[0][sizes][]">

                        <label>Product Number:</label>
                        <input type="text" name="product_details[0][product_numbers][]" required>
                    </div>
                </div>

                <button type="button" onclick="addProductSize(this)">Add Product Size</button>

                <!-- Product Images for the first Product Detail -->
                <div class="product-images-container">
                    <div class="product-image">
                        <label>Image:</label>
                        <input type="file" class="form-control" id="URL_image" name="URL_image" accept="image/*" required onchange="previewImage(this)">
                        <img id="imagePreview" src="#" alt="Ảnh xem trước" style="display: none; max-width: 100%; margin-top: 10px;">
                    </div>
                </div>

            </div>
        </div>

        <button type="button" onclick="addProductDetail()">Add Product Detail</button>

        <!-- Add more fields as needed -->

        <button type="submit">Add Product</button>
    </form>

    <script>
        function addProductDetail() {
            const container = document.getElementById('productDetailsContainer');
            const template = document.querySelector('.product-detail');
            const clone = template.cloneNode(true);

            container.appendChild(clone);
        }

        function addProductSize(button) {
            const productDetailContainer = button.closest('.product-detail');
            const sizesContainer = productDetailContainer.querySelector('.product-sizes-container');
            const template = sizesContainer.querySelector('.product-size');
            const clone = template.cloneNode(true);

            sizesContainer.appendChild(clone);
        }

        function previewImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

    </script>

@endsection
