<?php
    
    require_once('../libraries/PHPmailer.php');

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
    $register="Not a member? <a style='color: rgb(100,100,255); cursor: pointer;' onclick='showRegister(\"\",\"\",\"\",\"\",\"\",\"\");'>Sign up</a> for an account.";
    $cannot_access="<a style='color: rgb(100,100,255); cursor: pointer;' onclick='notaccess();'>Can't access your account?</a>";
    $cannot_access2="Can\'t access your account?";
    $contact_with_administrator="You should contact your system administrator.";
    
    $addincident="+ Add";
    $maintenance="Maintenance";
    $dependencies="Dependencies";
    $categories="Categories";
    $incidences="Incidences";
    $users="Users";
    $your_incidences="Yours Incidences";
    $reset="Reset incidences";
    $incidences_in_progress="In progress";
    $incidences_open="Open";
    $incidences_resolved="Resolved";
    $OK="OK";
    
// Registro
    $signup="Sign up";
    $signup_botton=$signup;
    $name="Name: ";
    $surname="Surname: ";
    $email="E-mail: ";
    $tlf="Phone: ";
    $confirm_password="Confirm password: ";
    $department="Department: ";
    
    $REGISTER_congratulation="Congratulation!";
    $REGISTER_OK_msg="You\'ve just created your account. Admin have to activate account before sign in. You will receive an e- mail when your account has been validated.";
    $REGISTER_ERROR_passwords1="The password must be at least 8 characters.";
    $REGISTER_ERROR_passwords2="The passwords do not match.";
    $REGISTER_ERROR_user="The user is already in use.";
    $REGISTER_ERROR_email="Invalid E-mail.";
    $REGISTER_ERROR_tlf="Invalid phone.";
    $REGISTER_ERROR_surname="Invalid surname";
    $REGISTER_ERROR_name="Invalid name";
    $REGISTER_ERROR_onInsert="This email is already associated with an account.";
     
         
// EMAILs
    $EMAIL_REGISTER_TITLE="Your user has been created!";
    $EMAIL_REGISTER_MSG=",<br><br><br>&nbsp&nbsp&nbsp welcome to <i><strong style='color: darkblue;'>QProb</strong>, to incident management in ".$organization.".</i><br><br><div style='font-size: 16px;text-align: center;'><p>If you have not requested the creation of this account, contact the center administrator.</p><p>If requested, must wait for validation by the person responsible for <strong style='color: darkblue;'>QProb</strong> in your center.</p></div></div><br><br><p style='text-align: right;'> <i>Thank you for using us.</i>";     
    
//  Login     
    $welcome="Welcome to <span>Q</span>Prob!";
    $login="Sign In";
    $login_OK="Sign In";
    $login_CANCEL="Cancel";
    $login_error="Incorrect";
    $login_error_message="User or password is incorrect.";
    $enter="Sign In";

// Name file without extension
    $filename = explode(".",basename($_SERVER['PHP_SELF']))[0];

// Database
    $db = new mysqli($server,$database_user,$database_password,$database);

// Languages
    $english="ENGLISH";
    $spanish="SPANISH";

    $correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()
/** 
* 
*   Los elementos no comunes se verán separados 
*   dependiendo del archivo que llame a este diccionario .php
*
*/