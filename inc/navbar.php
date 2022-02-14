<nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP Blog</a>
      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo ROOT_URL; ?>">Home</a>
          </li>
          <?php if(isset($_SESSION['isLoggedIn'])): ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo ROOT_URL; ?>addpost.php">Add Post</a>
            </li>
          <?php endif; ?>
        </ul>
        <?php if(isset($_SESSION['isLoggedIn'])): ?>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input class="form-control bg-danger" type="submit" value="Logout" name="logout">
          </form>
        <?php endif; ?>
        <?php if(!isset($_SESSION['isLoggedIn'])): ?>
          <a href="<?php echo ROOT_URL; ?>admin.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
