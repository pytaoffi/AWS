<?php
    session_start();
    require '../config/connection.php';
    require '../config/utility.php';

    $username=sanitizeString(mysqli_real_escape_string($conn, $_POST["username"]));
    $password=sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));


    $stmt = $conn->prepare("SELECT * FROM account WHERE username LIKE ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $message = "Nome utente inesistente";
        echo "<script>if(confirm('$message')){document.location.href='../public/login.html'};</script>";
    }else{
        $hashed_password=hash('sha256', $password.saltChar());
        $stmt = $conn->prepare("SELECT * FROM account WHERE username LIKE ? AND password LIKE ?");
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['user']=$username;
            if(isset($_SESSION['user'])) {
                $stmt->close();
                echo "<script> window.location = '../public/home.php';</script>";
            }
        } else {
            $message = "Password errata";
            echo "<script>if(confirm('$message')){document.location.href='../public/login.html'};</script>";
        }
    }
?>