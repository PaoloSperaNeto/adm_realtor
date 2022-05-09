<?php

session_start();

define('SITEURL', 'http://localhost/ADM_REALTOR/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'adm_realtor');


//connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($myConnection)); //conexão
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($myConnection)); //seleção do banco

?>