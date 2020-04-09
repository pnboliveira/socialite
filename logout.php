<?php

    session_start();
    
    session_unset();
    $_SESSION=$_POST=null;
    session_destroy();
    header('location:formLogin.php');
    exit;   
?>