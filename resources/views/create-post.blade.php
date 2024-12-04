<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css?v=').time()}}">
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
    <section>
        <h2>Create a New Post</h2>
        <div>
            <form method="POST" action="{{ route('posts.save') }}">
                @csrf

                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" id="title" name="title" required maxlength="60">
                </div>

                <div>
                    <label for="body">Post Content</label>
                    <textarea id="body" name="body" rows="10" required></textarea>
                </div>

                <button type="submit">Create Post</button>
            </form>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
