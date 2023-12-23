<!-- resources/views/create_shop.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    @if (session('username'))
        @php
            $shopProfile = \App\Models\shopProfile::where('username', session('username'))->first();
        @endphp
        <div class="image">
            <img src="{{ $shopProfile->avt }}" class="img-circle elevation-2" alt="Shop Image"
                style="width: 50px; height: 50px">
        </div>
        <div class="info">
            <h6>{{ $shopProfile->name_shop }}</h6>
        </div>
        
    <h1>Chờ xác nhận</h1>
    @endif
    <a href="{{ route('logout') }}">đăng xuất</a>
</body>

</html>
