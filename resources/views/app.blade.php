<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>A Blog</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css?v=').time()}}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

<header>
    <h1>Name of a blog</h1>
    <nav>
        <a href="/">Home</a>
        @auth
            @if(auth()->user()->role == 'admin')
                <a href="/admin/users">Manage users</a>
            @endif
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">Log out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <p>Logged in as: {{ Auth::user()->name }}</p>
        @else
            <a href="/login">Log in</a>
            <a href="/register">Register</a>
        @endauth
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
