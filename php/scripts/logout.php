<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['control_session']); 
    session_destroy();