<?php
    require('config/config.php');
    require('config/db.php');

    // create query
    $query = 'SELECT * FROM posts ORDER BY created_at DESC';

    // get result
    $result = mysqli_query($conn, $query);

    // fetch data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
    <div class="container mt-3">
        <h1 class="mb-3">Posts</h1>
        <?php foreach($posts as $post): ?>
            <div class="card px-4 py-3 mb-3">
                <h3><?php echo $post['title']; ?></h3>
                <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
                <p><?php echo $post['body']; ?></p>
                <a class="btn btn-primary" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        <?php endforeach ?>
    </div>
<?php include('inc/footer.php'); ?>