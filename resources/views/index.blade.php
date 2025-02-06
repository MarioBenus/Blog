@extends('app')

@section('content')
    <section class="posts">
        @if(auth()->check() && (auth()->user()->role === 'blogger' || auth()->user()->role === 'admin'))
            <a href="/create-post">
                <button >Create New Post</button>
            </a>
        @endif
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
@endsection

