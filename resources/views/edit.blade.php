<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Blog</title>
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
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT') <!-- Tells Laravel to handle the request as a PUT -->

        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required maxlength="60">
        </div>

        <div class="form-group">
            <label for="body">Post Content</label>
            <textarea name="body" id="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <button type="submit" style="background-color: blue; color:white">Update Post</button>
    </form>

    <!-- Delete Form -->
    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" style="background-color: red; color: white;">Delete Post</button>
    </form>
</main>

<footer>
    <a href="{{ route('home') }}">Back to Home</a>
</footer>
</body>
</html>
