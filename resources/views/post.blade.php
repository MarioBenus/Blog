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
    <article>
        <h2>
            <span class="post-title">{{ $post->title }}</span>
            <span class="post-author">by {{ $post->user->name }}</span>
        </h2>
        <p class="meta">Published <strong>{{ $post->created_at->format('F j, Y, H:i') }}</strong></p>
        @if ($post->updated_at > $post->created_at)
            <p class="meta">Edited <strong>{{ $post->updated_at->format('F j, Y, H:i') }}</strong></p>
        @endif

        <p>{{ $post->body }}</p>

    </article>

    @if(Auth::id() === $post->user_id)
        <div>
            <a href="{{ route('posts.edit', $post) }}">
                <button style="background-color: blue; color: white;">Edit</button>
            </a>

            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: red; color: white;">Delete</button>
            </form>
        </div>
    @endif


    <section>
        <h3>Comments</h3>


        <div>
            <p><strong>John Smith</strong> - October 20th 2024 15:34</p>
            <p>An interesting comment.</p>
        </div>


        <div>
            <p><strong>Jane Doe</strong> - October 20th 2024 16:22</p>
            <p>Another interesting comment</p>
        </div>


        <div>
            <form action="#" method="post">
                <label for="comment">Add a comment</label>
                <textarea id="comment" name="comment" rows="5" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 Author</p>
</footer>
</body>
</html>
