<?php
    $hostname="54.174.106.150";
    $username="user";
    $password="pass";
    $database="aws_cc";
    $port="3306";
    // creo la connessione
    $conn=new mysqli($hostname,$username,$password,$database,$port);
    // controllo la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    

?>