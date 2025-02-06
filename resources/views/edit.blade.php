@extends('app')

@section('content')
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
@endsection
