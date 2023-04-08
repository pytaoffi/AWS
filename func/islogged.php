<?php
    function seiloggato(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }
    
?>