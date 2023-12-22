<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-register-styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fontawesome-free-6.4.2-web/css/all.min.css')}}">\
</head>

<body>
    <div class="header"> <a href="{{ route('buyer.home') }}" class="logo" style="color: #000">
            <p><b>SEASIDE</b> STORE / <span style="color: #a0a5a8">Đăng ký / Seller</span></p>
        </a>
        <p style="font-size: 16px;color: #bf6d72">Bạn cần giúp đỡ?</p>
    </div>
    <div class="body">
        <div class="main">
            <div class="" id="">
                <form class="form" id="registrationForm" method="POST" action="" enctype="multipart/form-data">
                    <!-- Use appropriate route for registration -->
                    @csrf
                    <h1 class="form_title" style="color: black;">Thông tin về shop</h1>
                    <br>
                    <div class="form-group">
                        <label class="form__label" for="name_shop">Tên shop:</label>
                        <input class="form__input" type="text" name="name_shop" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label class="form__label" for="address">Địa chỉ:</label>
                        <input class="form__input" type="text" name="address" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label class="form__label" for="avt">Ảnh đại diện:</label>
                        <input class="form__input" type="file" name="avt" id="avt" onchange="previewImage('avt', 'avt_preview')" required>
                        <img id="avt_preview" alt="Preview" style="max-width: 100%; max-height: 70px;  display: none;">
                    </div>
                    <div class="form-group">
                        <label class="form__label" for="cover_image">Ảnh bìa:</label>
                        <input class="form__input" type="file" name="cover_image" id="cover_image" onchange="previewImage('cover_image', 'cover_image_preview')" required>
                        <img id="cover_image_preview" alt="Preview" style="max-width: 100%; max-height: 60px;  display: none;">
                    </div>
                    <button class="form__button button" type="submit">HOÀN TẤT ĐĂNG KÝ</button>
                </form>
                
                <script>
                    function previewImage(inputId, previewId) {
                        var input = document.getElementById(inputId);
                        var preview = document.getElementById(previewId);
                
                        var reader = new FileReader();
                
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                
                        if (input.files[0]) {
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                
                
            </div>


            
        </div>
    </div>
</body>

</html>
<script src="{{ asset('js/password-match.js') }}"></script>
<script src="{{ asset('js/togglePassword.js') }}"></script>
