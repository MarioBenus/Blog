// Comment deletion
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-comment').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const formId = this.getAttribute('data-form-id');

            if (confirm('Are you sure you want to delete this comment?')) {
                document.getElementById(formId).submit();
            }
        });
    });
});

// Likes
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.like-button').forEach(button => {
        const isLiked = button.getAttribute('data-liked') === 'true';
        if (isLiked) {
            button.classList.add('liked');
        }

        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const likeCountElement = this.querySelector('.like-count');

            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    likeCountElement.textContent = data.likes;
                    this.classList.toggle('liked', data.liked); // Toggle the liked class
                })
                .catch(error => console.error('Error:', error));
        });
    });
});


