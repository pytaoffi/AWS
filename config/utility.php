<?php

    function sanitizeString($data){
        $data = trim($data);                   //rimuove gli spazi prima e dopo la stringa 
        $data = stripslashes($data);    // rimuove gli slashes 
        $data=(filter_var($data, FILTER_SANITIZE_STRING));
        return $data;
    }

    

    function saltChars(){
        $salt='sistemi2023';
        return $salt;
    }

?>