<?php 

    if(!isset($_SESSION['user_check'])){

        $_SESSION['no_user_login_fail'] = "<div class='error_login text-center'><p>Você deve estar logado para ter acesso.</p></div>";
        header('location:'. SITEURL . 'admin/login.php');

    }
