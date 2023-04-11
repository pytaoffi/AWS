<?php
    require '../config/connection.php';
    require 'utility.php';

    $nome=sanitizeString(mysqli_real_escape_string($conn, $_POST["nome"]));
    $cognome=sanitizeString(mysqli_real_escape_string($conn, $_POST["cognome"]));
    $username=sanitizeString(mysqli_real_escape_string($conn, $_POST["username"]));
    $email=sanitizeString(mysqli_real_escape_string($conn, $_POST["email"]));
    $password=sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));
    
    if(isset($_POST['check'])){

        $stmt = $conn->prepare("SELECT * FROM account WHERE username LIKE ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

    
        if ($result->num_rows > 0) {
            $message = "Nome utente già presente";
            echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
        }else{
            $stmt = $conn->prepare("SELECT * FROM account WHERE email LIKE ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $message = "Email già presente";
                echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";  
            }else{
                $hashed_password=hash('ripemd160', $password.saltChars());
                
                $stmt = $conn->prepare("INSERT INTO account (nome, cognome, username, email, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $nome, $cognome, $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    echo "<script> window.location = '../public/login.html';</script>";
                } else {
                    $message = "errore:";
                    echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
                }
                $stmt->close();
                $conn->close();
            }
        }
    }else{
        $message = "Devi accettare i termini e le condizioni";
        echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
    }

    



    


?>