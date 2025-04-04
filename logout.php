<?php 
    session_start();
    session_unset();
    session_destroy();

    echo "<h2>You have been Logged out</h2>";
?>
<button class="btn btn-primary"><a href="/PROJECT/login.php">Go to Login</a></button>