<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social App</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
@include('partials/header')
<div class="main pt-16">
    @yield('content')
</div>
@include('partials/footer')
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
