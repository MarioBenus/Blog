@extends('app')

@section('content')
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
                    <textarea id="body" name="body" rows="30" required></textarea>
                </div>

                <button type="submit">Create Post</button>
            </form>
        </div>
    </section>
@endsection
