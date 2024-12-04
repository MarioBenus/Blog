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
        @auth
            <!-- Button to create a new post, visible only to authenticated users -->
            <a href="/create-post">
                <button >Create New Post</button>
            </a>
        @endauth
        <h2>Newest posts</h2>

        @if($posts->isEmpty())
            <p>No posts available.</p>
        @else
            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}">
                    <article>
                        <h2>
                            <span class="post-title">{{ Str::limit($post->title, 40) }}</span>
                            <span class="post-author">by {{ $post->user->name }}</span>
                        </h2>

                        <p>{{ Str::limit($post->body, 80) }}</p>
                    </article>
                </a>
            @endforeach
        @endif

    </section>
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
