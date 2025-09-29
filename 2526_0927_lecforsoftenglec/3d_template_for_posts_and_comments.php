<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Posts and Comments</title>
</head>
<body>

<div id="posts-container"></div>

<script>
async function fetchPostsAndComments() {
    try {
        const response = await fetch('3d_posts_and_comments_api.php'); 
        if (!response.ok) {
            throw new Error('HTTP error ' + response.status);
        }
        const posts = await response.json();

        const container = document.getElementById('posts-container');
        container.innerHTML = '';
        // container.textContent = JSON.stringify(posts);
        // console.log(posts);

        posts.forEach(post => {
            const postEl = document.createElement('div');
            postEl.innerHTML = `
                <h3>Post #${post.id}</h3>
                <p>${post.description}</p>
                <small><i>Date Added: ${post.date_added}</i></small>
                <h4>Comments:</h4>
                <ul>
                    ${post.comments.map(comment =>
                        `<li>
                            <p>${comment.description}</p>
                            <small><i>Date Added: ${comment.date_added}</i></small>
                        </li>`).join('')}
                </ul>
                <hr/>
            `;
            container.appendChild(postEl);
        });
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
}

fetchPostsAndComments();
</script>
</body>
</html>
