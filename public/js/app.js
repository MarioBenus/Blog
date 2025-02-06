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
                    this.classList.toggle('liked', data.liked);
                })
                .catch(error => console.error('Error:', error));
        });
    });
});

// User search and management
document.addEventListener("DOMContentLoaded", function () {
    function attachRoleChangeListeners() {
        document.querySelectorAll(".role-select").forEach(select => {
            select.addEventListener("change", function () {
                let userId = this.getAttribute("data-user-id");
                let roleId = this.value;
                // let status = this.parentElement.nextElementSibling.querySelector(".status");

                fetch(`/admin/users/${userId}/role`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ role_id: roleId }),
                })
            });
        });
    }

    attachRoleChangeListeners();

    const searchInput = document.getElementById('search');

    searchInput.addEventListener('keyup', function() {
        const query = searchInput.value;

        fetch('/admin/users/search?query=' + query)
            .then(response => response.text())
            .then(data => {
                const tbody = document.querySelector('#user-table tbody');
                tbody.innerHTML = data;
                attachRoleChangeListeners();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
});

// Clear search bar after a reload
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('search');
    searchInput.value = '';
});

document.addEventListener("DOMContentLoaded", function () {
    let popups = document.querySelectorAll(".popup");

    popups.forEach(popup => {
        popup.style.display = "block"; // Show popup

        setTimeout(() => {
            popup.style.animation = "fadeOut 0.5s ease-out";
            setTimeout(() => popup.style.display = "none", 400); // Hide after fade-out
        }, 3000);
    });
});


