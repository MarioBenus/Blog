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
        <a href="index.html">Home</a>
        <a href="login.html">Log in</a>
    </nav>
</header>


<main class="container">
    <article class="blog-post-full">
        <h2>Post title</h2>
        <p class="meta">Published <strong>October 20th 2024</strong></p>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at tortor lorem. Praesent sed diam nec risus convallis varius. Suspendisse potenti.</p>
        <p>Curabitur a orci quis justo bibendum tempus. Donec vehicula, lectus sed suscipit cursus, neque nunc fermentum eros, et maximus arcu nulla eu urna. Duis suscipit, tortor id efficitur fringilla, nunc nunc dignissim odio, at vehicula eros nulla id est.</p>
        <p>Ut ultrices purus sed felis commodo, a viverra ex dictum. Aliquam erat volutpat. Suspendisse aliquet lacus nec tempor dictum. Etiam lacinia ipsum vel augue aliquet, vel varius nunc vehicula. Donec vitae nunc metus. Phasellus ultricies feugiat quam sit amet vulputate. </p>

    </article>


    <section class="comments">
        <h3>Comments</h3>


        <div class="comment">
            <p><strong>John Smith</strong> - October 20th 2024 15:34</p>
            <p>An interesting comment.</p>
        </div>


        <div class="comment">
            <p><strong>Jane Doe</strong> - October 20th 2024 16:22</p>
            <p>Another interesting comment</p>
        </div>


        <div class="comment-form">

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