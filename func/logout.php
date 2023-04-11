<?php
    session_destroy();
    unset($_SESSION["user"]);
    $message = "Log out completato";
    echo "<script>if(confirm('$message')){document.location.href='../public/login.html'};</script>"
?>
    