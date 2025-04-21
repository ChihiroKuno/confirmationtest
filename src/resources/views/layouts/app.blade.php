<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
@hasSection('header')
    @yield('header')
@else
    <header>
        <h1>FashionablyLate</h1>
        <nav>
            @if (request()->routeIs('register'))
                <a href="{{ route('login') }}" class="nav-button">login</a>
            @elseif (request()->routeIs('login'))
                <a href="{{ route('register') }}" class="nav-button">register</a>
            @elseif (request()->is('admin*'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-button">logout</button>
                </form>
            @endif
        </nav>
    </header>
@endif

    <main>
        @yield('content')
    </main>
</body>
</html>