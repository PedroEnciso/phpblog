<?php
    require('config/config.php');
    require('config/db.php');
    include('config/functions.php');

    // keep track of error
    $error = '';

    // check for submit
    if (isset($_POST['submit'])) {
        // get form data
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);

        $query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";

        if(mysqli_query($conn, $query)) {
            header('Location: ' .ROOT_URL);
        } else {
            $error = 'ERROR: ' .mysqli_error($conn);
        }
    }
?>

<?php include('inc/header.php'); ?>
    <div class="container mt-3">
        <h1>Add Post</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea type="text" name="body" class="form-control"></textarea>
            </div>
            <p class="text-danger" ><?php echo $error; ?></p>
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
        
        </form>
    </div>
<?php include('inc/footer.php'); ?>