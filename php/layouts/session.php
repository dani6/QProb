<?php
    //
    // Session initial configuration         
    //
    session_start([
        'cookie_lifetime' => 86400,
    ]); // This sends a persistent cookie that lasts a day.
    session_name(($SESSION_NAME = "QProb - Incident Manager"));
    
    require( '../../config.php');
     
    // At the beginning $_SESSION['language'] is empty.
    // So, It could be necessary initialize
    if(empty($_SESSION['language']))
        $_SESSION['language']= $default_language;
    
    // Depending on selected language we export a dictionary.
    if($_SESSION['language']=="ES")
        require('../../resources/dictionaries/dictionary_ES.php');
    else
        require('../../resources/dictionaries/dictionary_EN.php');
      
    // $_SESSION['user'] is empty or $_SESSION['control_session'], you need to log in.
    if((empty($_SESSION['user']) || empty($_SESSION['control_session']))&&$filename!="login"&&$filename!="checkUser"&&$filename!="register")
        header('Location: login.php');