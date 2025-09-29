<!-- json.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Posts List</title>
</head>
<body>
    <h1>Posts</h1>
    <div id="posts-container">Loading posts...</div>

    <script>
        async function fetchPosts() {
            try {
                const response = await fetch('3c_posts_api.php');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const posts = await response.json();

                if (posts.error) {
                    document.getElementById('posts-container').textContent = 'Error: ' + posts.error;
                    return;
                }

                if (posts.length === 0) {
                    document.getElementById('posts-container').textContent = 'No posts found.';
                    return;
                }

                const container = document.getElementById('posts-container');
                container.innerHTML = ''; // clear loading text
                console.log(posts);
                console.log(JSON.stringify(posts));

                posts.forEach((post) => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <p><strong>Description:</strong> ${post.description}</p>
                        <p><em>Date Added:</em> ${post.date_added}</p>
                        <hr/>
                    `;
                    container.appendChild(div);
                });

            } catch (err) {
                document.getElementById('posts-container').textContent = 'Failed to fetch posts: ' + err.message;
            }
        }

        fetchPosts();
    </script>
</body>
</html>
