<?php
    require('config/config.php');
    require('config/db.php');
    include('config/functions.php');

    // keep track of the error
    $error = '';

    // get id from url
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // check for delete
    if (isset($_POST['delete'])) {
        // get id of the deleted post
        $delete_id = $_POST['delete_id'];

        $query = "DELETE FROM posts WHERE id = {$delete_id}";

        if(mysqli_query($conn, $query)) {
            header('Location: ' .ROOT_URL);
        } else {
            $error = 'ERROR: ' .mysqli_error($conn);
        }
    }

    // create query
    $query = 'SELECT * FROM posts WHERE id =' .$id;

    // get result
    $result = mysqli_query($conn, $query);

    // fetch data
    $post = mysqli_fetch_assoc($result);

    // free result
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="<?php echo ROOT_URL; ?>">Back</a>
        <h1><?php echo $post['title']; ?></h1>
        <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
        <p><?php echo $post['body']; ?></p>
        <hr>
        <p class="text-danger"><?php echo $error ?></p>
        <?php if(isset($_SESSION['isLoggedIn'])): ?>
            <a href="<?php ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary mb-2">Edit post</a>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="pull-right">
                <input type="hidden" value="<?php echo $post['id']; ?>" name="delete_id">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php endif; ?>
    </div>
<?php include('inc/footer.php'); ?>