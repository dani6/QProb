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
    $type="Tipo";
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

//Dependencies
    $DEPENDENCIES_dependencies="Dependencias";
    $DEPENDENCIES_delete="¡Borrado!";
    $DEPENDENCIES_verify_deleted="Se ha eliminado correctamente";
    $DEPENDENCIES_confirm="¿Está seguro?";
    $DEPENDENCIES_warning="¡No se podrá deshacer el cambio!";
    $DEPENDENCIES_added="¡Añadido!";
    $DEPENDENCIES_verify_added="Ha sido añadido correctamente";
    $DEPENDENCIES_error="¡Error!";
    $DEPENDENCIES_error_message="Ha ocurrido un error. Posiblemente el aula ya existe.";
    $DEPENDENCIES_add_classroom="Añadir aula";
    $DEPENDENCIES_accept="Aceptar";
    $DEPENDENCIES_cancel="CANCELAR";
    $DEPENDENCIES_delete_accept="Sí, borrar dependencia.";
    $DEPENDENCIES_add="Añadir +";
    $DEPENDENCIES_how_to_add="Cómo añadir edificios y plantas";
    $DEPENDENCIES_instructions="Se pueden utilizar los siguientes comandos en el terminal de MySQL para añadir edificios y plantas:</p><p style='color: blue;margin-top: 20px;'>INSERT INTO EDIFICIO VALUES (0, '--NOMBRE EDIFICIO--');</p><p style='color: blue;margin-top: 20px;'>INSERT INTO PLANTA VALUES (0,--NUMERO_PLANTA--,(select id from edificio where nombre like '--NOMBRE_EDIFICIO--'));</p><p style='margin-top: 30px;'>O puede utilizar una interfaz para el manejo de la base de datos.</p><p> El motivo principal por el que no se puede añadir es debido a que los edificios y plantas no suelen cambiar con relativa frencuencia.</p>";
    $DEPENDENCIES_question=" ¿Desea añadir edificios y plantas nuevos?";
    $DEPENDENCIES_select_build=" -- Selecciona un edificio";
    $DEPENDENCIES_select_floor=" -- Selecciona una planta";
    $DEPENDENCIES_select_classroom=" -- Selecciona un aula";
    $DEPENDENCIES_build="Edificio";
    $DEPENDENCIES_floor="Planta";
    $DEPENDENCIES_classroom="Aula";
    
// Categories
    $CATEGORIES_categories="Categorías";
    $CATEGORIES_select=" -- Selecciona una categoría";
    $CATEGORIES_verify_deleted="Se ha eliminado correctamente.";
    $CATEGORIES_added="¡Añadido!";
    $CATEGORIES_cancel_accept="Sí, borrar categoría.";
    $CATEGORIES_error_message="Ha ocurrido un error. Posiblemente la categoría ya existe.";
    $CATEGORIES_intro_category="Introduzca una categoría";

// Users

    $USERS_users="Usuarios";
    $USERS_validate="Validar usuario.";
    $USERS_verify_validate="¿Está seguro? El usuario podrá identificarse en la plataforma";
    $USERS_confirm="Sí, validar usuario";
    $USERS_validated="¡Validado!";
    $USERS_validated_message="El usuario ha sido validado correctamente.";
    $USERS_deleted="El usuario ha sido eliminado.";
    $USERS_edit="Editar usuario";
    $USERS_correct="Correcto";
    $USERS_search_name="Buscar por nombre:";
    $USERS_search_department="Buscar por departamento:";
    $USERS_search_mail="Buscar por e-mail:";
    $USERS_search_type="Buscar por tipo de cuenta:";
    $USERS_any="--CUALQUIER--";
    $USERS_normal="NORMAL";
    $USERS_technical="TÉCNICO";
    $USERS_special="ESPECIAL";
    $USERS_admin="ADMIN";
    $USERS_unvalidated="Usuarios no validados";
    $USERS_name="NOMBRE";
    $USERS_surname="APELLIDOS";
    $USERS_department="DEPARTAMENTO";
    $USERS_type="TIPO";
    $USERS_users_unvalidated="No existen usuarios no validados.";
    $USERS_users_validated="No existen usuarios válidos.";
    $USERS_validated="Usuarios validados";
    $USERS_delete_accept="Sí, borrar usuario.";
    $USERS_validar="Validar";
    $USERS_editar="Editar";
    
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