<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
     
    // Change $_SESSION['language'] variable 
    if($_POST['language']=="ES"){
        $_SESSION['language']="ES";
    }else{
        $_SESSION['language']="EN";
    }