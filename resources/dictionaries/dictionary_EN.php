<?php
/**
*
*   Elementos comúnes para todas las páginas.
*
*/

    $user=$_SESSION['user'];

    $user_text="User";
    $password_text="Password";

    $profile="Profile";
    $manage_account="Manage Account";
    $logout="Log Out";
    $description="Incident Management System v1.0";
    $register="Not a member? <a style='color: rgb(100,100,255); cursor: pointer;' onclick='window.location=\"register.html\"'>Sign up</a> for an account.";
    $cannot_access="<a style='color: rgb(100,100,255); cursor: pointer;' onclick='notaccess();'>Can't access your account?</a>";
    $cannot_access2="Can\'t access your account?";
    $contact_with_administrator="You should contact your system administrator.";
    
    $login="Sign In";
    $login_OK="Sign In";
    $login_CANCEL="Cancel";
    $login_error="Incorrect";
    $login_error_message="User or password is incorrect.";
    

// Name file without extension
    $filename = explode(".",basename($_SERVER['PHP_SELF']))[0];

// Database
    $db = new mysqli($server,$database_user,$database_password,$database);

// Languages
    $english="ENGLISH";
    $spanish="SPANISH";


/** 
* 
*   Los elementos no comunes se verán separados 
*   dependiendo del archivo que llame a este diccionario .php
*
*/