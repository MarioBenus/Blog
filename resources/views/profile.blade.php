@extends('app')

@section('content')
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
@endsection
