<?php 
if(isset($_POST['logout'])) {
    logout();
}

function logout() {
    session_destroy();
    unset($_SESSION['isLoggedIn']);
    header('Location: ' .ROOT_URL);
}

?>