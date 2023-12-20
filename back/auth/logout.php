<?php

session_start();

require_once('../../back/queries/queries.php');

if(isset($_SESSION['id'])) {

    logout($_SESSION['id']);

    session_destroy();
    
    header('Location: ../../front/auth/login.php');
}