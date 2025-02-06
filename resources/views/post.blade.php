@extends('app')

@section('content')
    <article>
        <h2>
            <span class="post-title">{{ $post->title }}</span>
            <span class="post-author">by <a href="{{ route('user.profile', $post->user->id) }}">{{ $post->user->name }}</a></span>
        </h2>
        <p class="meta">Published <strong>{{ $post->created_at->format('F j, Y, H:i') }}</strong></p>
        @if ($post->updated_at > $post->created_at)
            <p class="meta">Edited <strong>{{ $post->updated_at->format('F j, Y, H:i') }}</strong></p>
        @endif

        <p>{{ $post->body }}</p>

        @auth
            <button
                class="like-button"
                data-post-id="{{ $post->id }}"
                data-liked="{{ $post->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
                ❤️ <span class="like-count">{{ $post->likes->count() }}</span>
            </button>
        @else
            <p>❤️ {{ $post->likes->count() }}</p>
        @endauth

    </article>

    @if(Auth::id() === $post->user_id)
        <div>
            <a href="{{ route('posts.edit', $post) }}">
                <button style="background-color: blue; color: white;">Edit</button>
            </a>
        </div>
    @endif
    @if(Auth::id() === $post->user_id || (auth()->check() && auth()->user()->role === 'admin'))
        <div>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: red; color: white;">Delete</button>
            </form>
        </div>
    @endif


    <section>
        <h2>Comments</h2>

        @auth
            <div>
                <form action="{{ route('comments.store', $post->id) }}" method="post">
                    @csrf
                    <label for="body">Add a comment</label>
                    <textarea id="body" name="body" rows="5" required></textarea>

                    <button type="submit">Send</button>
                </form>
            </div>
        @else
            <p>Log in to add a comment.</p>
        @endauth

        @foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
            <div class="comment">
                <p>
                    <strong>{{ $comment->user->name }}</strong> <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                    @if (auth()->id() === $comment->user_id || (auth()->check() && auth()->user()->role === 'admin'))
                        <a href="#" class="delete-comment" data-form-id="delete-comment-{{ $comment->id }}">
                            Delete
                        </a>

                        <form id="delete-comment-{{ $comment->id }}"
                              action="{{ route('comments.destroy', $comment->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </p>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
    </section>
@endsection
