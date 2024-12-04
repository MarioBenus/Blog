<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Blog</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>
<body>
<header>
    <h1>Name of a blog</h1>
    <nav>
        <a href="/">Home</a>
        @auth
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                Log out
            </a>

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
    <section class="posts">
        <h2>Newest posts</h2>
        <a href="post.html">
            <article>
                <h3>Post number 1</h3>
                <p>A short description...</p>
            </article>
        </a>

        <a href="post.html">
            <article>
                <h3>Post number 2</h3>
                <p>A short description...</p>
            </article>
        </a>

    </section>
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
