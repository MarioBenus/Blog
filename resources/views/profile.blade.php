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
    <section class="user-info">
        <h1>{{ $user->name }}'s Profile</h1>
        <p>Email: {{ $user->email }}</p>
    </section>

    <section class="user-stats">
        <h2>Statistics</h2>
        <ul>
            <li>Created on: {{ $user->created_at->format('d.m.Y') }}</li>
            <li>Posts: {{ $postCount }}</li>
            <li>Comments: {{ $commentCount }}</li>
            <li>Likes received: {{ $likeCount }}</li>
        </ul>
    </section>

    <section class="posts">
        <h2>Posts by {{ $user->name }}</h2>
        @forelse ($user->posts as $post)
            <a href="{{ route('posts.show', $post->id) }}">
                <article>
                    <h2>
                        <span class="post-title">{{ Str::limit($post->title, 40) }}</span>
                        <span class="post-author">by {{ $post->user->name }}</span>
                    </h2>
                    <p>{{ Str::limit($post->body, 80) }}</p>
                </article>
            </a>
        @empty
            <p>No posts yet.</p>
        @endforelse
    </section>
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
