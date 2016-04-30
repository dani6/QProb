<?php
/**
*
*   Elementos comúnes para todas las páginas.
*
*/

    $user=$_SESSION['user'];

    $user_text="Usuario";
    $password_text="Contraseña";

    $profile="Perfil";
    $manage_account="Gestionar Cuenta";
    $logout="Cerrar sesión";
    $description="Sistema de gestión de incidencias v1.0";
    $register="¿No eres miembro? <a onclick='window.location=\"register.html\"'>Regístrate</a> y consigue una cuenta.";
    $cannot_access="<a onclick='notaccess();'>¿No puedes acceder a tu cuenta?</a>";
    $cannot_access2="¿Problemas de acceso?";
    $contact_with_administrator="Contacta con el adminsitrador del sistema.";
    
// Variables para la ventana de inicio de sesión.
    $login="Iniciar sesión";
    $login_OK="Entrar";
    $login_CANCEL="Cancelar";
    $login_error="Incorrecto";
    $login_error_message="Usuario o contraseña incorrecta.";

// Nombre del fichero sin la extension.
    $filename = explode(".",basename($_SERVER['PHP_SELF']))[0];
    
// Base de datos
    $db = new mysqli($server,$database_user,$database_password,$database);
    $acentos = $db->query("SET NAMES 'utf8'"); // Acentos para el idioma español.

// Idiomas
    $english="INGLÉS";
    $spanish="ESPAÑOL";

/** 
* 
*   Los elementos no comunes se verán separados 
*   dependiendo del archivo que llame a este diccionario .php
*
*/

?>