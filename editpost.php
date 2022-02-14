<?php
    require('config/config.php');
    require('config/db.php');

    // keep track of error
    $error = '';

    // check for submit
    if (isset($_POST['submit'])) {
        // get id of the edited post
        $edit_id = $_POST['edit_id'];

        // get form data
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);

        $query = "UPDATE posts SET
                    title='$title',
                    author='$author',
                    body='$body'
                        WHERE id = {$edit_id}";

        if(mysqli_query($conn, $query)) {
            header('Location: ' .ROOT_URL);
        } else {
            $error = 'ERROR: ' .mysqli_error($conn);
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // get the id of the post to edit
        $id = mysqli_real_escape_string($conn, $_GET['id']);
    }

    // create query
    $query = 'SELECT * FROM posts WHERE id =' .$id;

    // get result
    $result = mysqli_query($conn, $query);

    // fetch data, use data to fill in form values
    $post = mysqli_fetch_assoc($result);

    // free result
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
    <div class="container mt-3">
        <h1>Add Post</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title'] ?>">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author'] ?>">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea type="text" name="body" class="form-control"><?php echo $post['body'] ?></textarea>
            </div>
            <p class="text-danger" ><?php echo $error; ?></p>
            <input type="hidden" value="<?php echo $post['id']; ?>" name="edit_id">
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
        
        </form>
    </div>
<?php include('inc/footer.php'); ?>