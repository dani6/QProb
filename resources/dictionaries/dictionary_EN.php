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
    $type="Type";
    $profile="Profile";
    $manage_account="Manage Account";
    $logout="Log Out";
    $description="Incident Management System v1.0";
    $register="Not a member? <a style='color: rgb(100,100,255); cursor: pointer;' onclick='showRegister(\"\",\"\",\"\",\"\",\"\",\"\");'>Sign up</a> for an account";
    $cannot_access="<a style='color: rgb(100,100,255); cursor: pointer;' onclick='notaccess();'>Can't access your account?</a>";
    $cannot_access2="Can\'t access your account?";
    $contact_with_administrator="You should contact your system administrator.";
    
    $addincident="+ Add";
    $maintenance="Maintenance";
    $dependencies="Dependencies";
    $categories="Categories";
    $category="Category";
    $status="Status";
    $title="Title";
    $incidences="Incidences";
    $users="Users";
    $your_incidences="Your Incidences";
    $reset="Reset incidences";
    $incidences_in_progress="In progress";
    $incidences_open="Open";
    $incidences_resolved="Resolved";
    $OK="OK";
    $delete="Delete";
    $pdf="A PDF file with information about the deleted incidences will be generated.";
    $in="In";

    
// Registro
    $signup="Sign up";
    $signup_botton=$signup;
    $name="Name ";
    $surname="Surname ";
    $email="E-mail ";
    $tlf="Phone ";
    $confirm_password="Confirm password ";
    $department="Department: ";
    $tipo_name="Type";
    $place="Place";
    $date="Date";
    $department2="Department";
    
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

//Dependencies
    $DEPENDENCIES_dependencies="Dependencies";
    $DEPENDENCIES_delete="Deleted!";
    $DEPENDENCIES_verify_deleted="Your dependency has been deleted";
    $DEPENDENCIES_confirm="Are you sure?";
    $DEPENDENCIES_warning="You won\'t be able to revert this!";
    $DEPENDENCIES_added="Added!";
    $DEPENDENCIES_verify_added="Your dependency has been added.";
    $DEPENDENCIES_error="Error!";
    $DEPENDENCIES_error_message="An error has been happened. The classroom may already exists.";
    $DEPENDENCIES_add_classroom="Add classroom";
    $DEPENDENCIES_accept="Accept";
    $DEPENDENCIES_cancel="CANCEL";
    $DEPENDENCIES_delete_accept="Yes, delete it!";
    $DEPENDENCIES_add="Add +";
    $DEPENDENCIES_how_to_add="How to add buildings and floors";
    $DEPENDENCIES_instructions="You can use the following commands in the terminal of mysql for add buildings and floors:</p><p style='color: blue;margin-top: 20px;'>INSERT INTO EDIFICIO VALUES (0, '--NOMBRE EDIFICIO--');</p><p style='color: blue;margin-top: 20px;'>INSERT INTO PLANTA VALUES (0,--NUMERO_PLANTA--,(select id from edificio where nombre like '--NOMBRE_EDIFICIO--'));</p><p style='margin-top: 30px;'> Or you can use a interface for the handling of data base.</p><p>The main reason why you can not add it because the buildings and plants do not usually change relatively frequency.</p>";
    $DEPENDENCIES_question=" Do you wish add a new buildings and floors?";
    $DEPENDENCIES_select_build=" -- Select a building";
    $DEPENDENCIES_select_floor=" -- Select a floor";
    $DEPENDENCIES_select_classroom=" -- Select a classroom";
    $DEPENDENCIES_build="Building";
    $DEPENDENCIES_floor="Floor";
    $DEPENDENCIES_classroom="Classroom";
    
// Categories

    $CATEGORIES_categories="Categories";
    $CATEGORIES_select=" -- Select a category";
    $CATEGORIES_verify_deleted="Your category has been deleted.";
    $DEPARTMENT_verify_deleted="Your department has been deleted.";
    $CATEGORIES_added="Category has been added";
    $DEPARTMENT_added="Department has been added";
    $CATEGORIES_cancel_accept="Yes, delete category.";
    $DEPARTMENT_cancel_accept="Yes, delete department.";
    $CATEGORIES_error_message="An error has been happened. The category may already exists.";
    $DEPARTMENT_error_message="An error has been happened. The department may already exists.";
    $CATEGORIES_intro_category="Enter a category";
    $DEPARTMENT_intro_category="Enter a department";
    
// Users

    $USERS_users="Users";
    $USERS_validate="Validated user";
    $USERS_verify_validate="Are you sure? User may be able to sign in at the platform";
    $USERS_confirm="Yes, validate it!";
    $USERS_validated="Validated!";
    $USERS_validated_message="User has been validated successfully.";
    $USERS_deleted="User has been deleted.";
    $USERS_edit="Edit user";
    $USERS_correct="Correct";
    $USERS_search_name="Search by name:";
    $USERS_search_department="Search by department:";
    $USERS_search_mail="Search by e-mail:";
    $USERS_search_type="Search by account type:";
    $USERS_any="--ANY--";
    $USERS_normal="NORMAL";
    $USERS_technical="TECHNICAL";
    $USERS_special="SPECIAL";
    $USERS_admin="ADMIN";
    $USERS_unvalidated="Unvalidated users";
    $USERS_name="NAME";
    $USERS_surname="SURNAME";
    $USERS_department="DEPARTMENT";
    $USERS_type="TYPE";
    $USERS_users_unvalidated="There are no users unvalidated.";
    $USERS_users_validated="There are no users validated.";
    $USERS_validated="Validated users";
    $USERS_delete_accept="Yes, do it.";
    $USERS_validar="Validate";
    $USERS_editar="Edit";
    $USERS_change_pass="Change password";
    $reset_form="Reset";
    $USERS_congratulation="Congratulations!";
    $USERS_changed_pass="The password has been changed";
    $USERS_confirm_pass="Enter your password: ";
    $USERS_error_confirm_pass="The password is incorrect.";
    
// Incidencies

    $INCIDENCIES_user_name="User name:";
    $INCIDENCIES_type="Type:";
    $INCIDENCIES_name="Name:";
    $INCIDENCIES_title="Title:";
    $INCIDENCIES_department="Department:";
    $INCIDENCIES_select_type="-- Select type";
    $INCIDENCIES_select_build="-- Select build";
    $INCIDENCIES_floor="-- Floor";
    $INCIDENCIES_select_classroom="-- Select classroom";
    $INCIDENCIES_delete_incidence="Delete incidence";
    $INCIDENCIES_urgent_incidence="Urgent incidence";
    $INCIDENCIES_no_exist_urgent="There are no urgent incidences.";
    $INCIDENCIES_others_incidences="Other incidences";
    $INCIDENCIES_no_exist_incidences="There are no incidences.";
    $INCIDENCIES_deleted="The incidence has been deleted";
    $INCIDENCIES_delete_all="Delete all incidences?";
    $INCIDENCIES_missing_field="Missing fields";
    $INCIDENCIES_deleted_all="The incidences has been deleted";
    $INCIDENCIES_added="Added incidence";
    $INCIDENCIES_has_been_added="The incidence has been added";
    $INCIDENCIES_show_incidence="Show incidence";
    
    
    $OBSERVACION="Comment";
    $INCIDENCIES_comment="+ Comment";
    $INCIDENCIES_show_comment="Show Comments";
    $INCIDENCIES_accept_incidence="Take over this incidence";
    $INCIDENCIES_resolved_incidence="Resolved incidence";
    $INCIDENCIES_new_comment="New comment";
    $INCIDENCIES_total_cost="Total cost:";
    $INCIDENCIES_total_expense="Total expense";
    $INCIDENCIES_state="State:";
    $INCIDENCIES_delete_comment="Delete comment";
    $INCIDENCIES_comment_added="The comment has been added";
    $INCIDENCIES_comment_error="There was an error, please try again";
    $INCIDENCIES_description="Description";
    $INCIDENCIES_change_status="Change status";
    
    $INCIDENCIES_incidence="Incidence";
    $INCIDENCIES_incidences="Incidences";
    $INCIDENCIES_resolved="Resolved incidences";
    $INCIDENCIES_openned="Openned incidences";
    $INCIDENCIES_in_progress="Incidences in progress";
    
// Your Incidences

    $YOUR_INC_your_incidence="Your incidences";
    $YOUR_INC_in_progress="Your incidences in progress";
    $YOUR_INC_openned="Your openned incidences";
    $YOUR_INC_resolved="Your resolved incidences";
    
    $INDEX_USER_INCIDENCIAS_NOT="Your incidences are not being resolved.";
    $INDEX_USER_INCIDENCIAS_CARRIED_OUT="They are carried out the following incidences:";
    $INDEX_USER_PRINT="PRINT OPEN INCIDENCES";
    $INDEX_USER_INFORMATION="Information";
    $INDEX_USER_TOTAL1="Total open incidences this month";
    $INDEX_USER_TOTAL2="Total incidences resolved this month";
    $INDEX_USER_TOTAL3="In progress incidences this month";
    $INDEX_USER_TOTAL4="Total budget of this year";
    $INDEX_TOTAL_INCIDENCIAS="Total incidences";
    $MONTH1="January";
    $MONTH2="February";
    $MONTH3="March";
    $MONTH4="April";
    $MONTH5="May";
    $MONTH6="June";
    $MONTH7="July";
    $MONTH8="August";
    $MONTH9="September";
    $MONTH10="October";
    $MONTH11="November";
    $MONTH12="December";
    
    $DEPARTMENT_select="-- Select a deparment";
// Observaciones    
    $COMMENT_order="Order:";
    $COMMENT_estimate="Estimate:";
    $COMMENT_no_comment="There are no comments for this incidence.";
    
// Name file without extension
    $filename = explode(".",basename($_SERVER['PHP_SELF']))[0];

// Database
    $db = new mysqli($server,$database_user,$database_password,$database);
    $acentos = $db->query("SET NAMES 'utf8'"); // Acentos para el idioma español.
    
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