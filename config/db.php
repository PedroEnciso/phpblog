<?php 
    // create connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // check connection
    if(!$conn) {
        echo 'Failed to connect to database! ' .mysqli_connect_errno();
    }