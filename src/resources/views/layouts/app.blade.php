<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fmm</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')

</head>
<body>
    <header>
        <div class="header-logo">
            <a href="/" class="header-logo-link"><img class="header-logo-image" src="{{asset('items/logo.svg')}}" alt=""></a>
        </div>
        @yield('nav')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>