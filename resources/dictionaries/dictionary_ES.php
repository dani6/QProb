<?php
    require_once('../libraries/PHPmailer.php');

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
    $register="¿No eres miembro? <a onclick='showRegister(\"\",\"\",\"\",\"\",\"\",\"\");'>Crea una cuenta</a>.";
    $cannot_access="<a onclick='notaccess();'>¿No puedes acceder a tu cuenta?</a>";
    $cannot_access2="¿Problemas de acceso?";
    $contact_with_administrator="Contacta con el adminsitrador del sistema.";
    
    $addincident="+ Nueva";
    $maintenance="Mantenimiento";
    $dependencies="Dependencias";
    $categories="Categorias";
    $incidences="Incidencias";
    $users="Usuarios";
    $your_incidences="Tus incidencias";
    $reset="Resetear incidencias";
    $incidences_in_progress="En curso";
    $incidences_open="Abiertas";
    $incidences_resolved="Resueltas";
    $OK="Aceptar";
    
// Registro
    $signup="Crea una cuenta";
    $signup_botton="Crear";
    $name="Nombre: ";
    $surname="Apellidos: ";
    $email="E-mail: ";
    $tlf="Teléfono: ";
    $confirm_password="Confirmar contraseña: ";
    $department="Departamento: ";
     
    $REGISTER_congratulation="¡Bienvenido!";
    $REGISTER_OK_msg="Su cuenta ha sido creada. El admnistrador deberá validar su cuenta antes de poder acceder a ella. Recibirá un correo cuando su cuenta sea validada.";
    $REGISTER_ERROR_passwords1="La contraseña debe tener al menos 8 caracteres.";
    $REGISTER_ERROR_passwords2="Las contraseñas no coinciden.";
    $REGISTER_ERROR_user="El nombre de usuario está en uso.";
    $REGISTER_ERROR_email="E-mail no válido.";
    $REGISTER_ERROR_tlf="Teléfono no válido.";
    $REGISTER_ERROR_surname="Apellidos no válido.";
    $REGISTER_ERROR_name="Nombre no válido.";
    $REGISTER_ERROR_onInsert="Es posible que el E-mail ya tenga una cuenta asociada.";
     
         
// EMAILs
    $EMAIL_REGISTER_TITLE="¡Su usuario ha sido creado!";
    $EMAIL_REGISTER_MSG=",<br><br><br>&nbsp&nbsp&nbsp bienvenido a la aplicación <i><strong style='color: darkblue;'>QProb</strong>, para la gestión de incidencias en ".$organization.".</i><br><br><div style='font-size: 16px;text-align: center;'><p>Si usted no ha solicitado la creación de está cuenta, póngase en contacto con el administrador del centro.</p><p>Si lo ha solicitado, deberá esperar a la validación por parte del responsable de la aplicación <strong style='color: darkblue;'>QProb</strong> de su centro.</p></div></div><br><br><p style='text-align: right;'> <i>Gracias por usarnos.</i>";
    
// Variables para la ventana de inicio de sesión.
    $welcome="¡Bienvenido a <span>Q</span>Prob!";
    $login="Iniciar sesión";
    $login_OK="Entrar";
    $login_CANCEL="Cancelar";
    $login_error="Incorrecto";
    $login_error_message="Usuario o contraseña incorrecta.";
    $enter="Entrar";
// Nombre del fichero sin la extension.
    $filename = explode(".",basename($_SERVER['PHP_SELF']))[0];
    
// Base de datos
    $db = new mysqli($server,$database_user,$database_password,$database);
    $acentos = $db->query("SET NAMES 'utf8'"); // Acentos para el idioma español.

// Idiomas
    $english="INGLÉS";
    $spanish="ESPAÑOL";

    $correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()
/** 
* 
*   Los elementos no comunes se verán separados 
*   dependiendo del archivo que llame a este diccionario .php
*
*/

?>