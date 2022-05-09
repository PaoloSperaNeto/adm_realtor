<?php
include('../config/constants.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - ADM REALTOR</title>

    <link rel="stylesheet" href="../css/adm_stl.css">

</head>

<body class="background_body">

    <div class="login">
        <h1 class="text-center">ADM REALTOR</h1><br>
        <?php
        if (isset($_SESSION['login_fail'])) {
            echo ($_SESSION['login_fail']);
            unset($_SESSION['login_fail']);
        }

        ?>
        <?php
        if (isset($_SESSION['no_user_login_fail'])) {
            echo ($_SESSION['no_user_login_fail']);
            unset($_SESSION['no_user_login_fail']);
        }

        ?>
        <br><br><br>
        <form action="" method="POST" class="text-center">
            Usuário: <br>
            <input type="text" name="username" placeholder="Usuário..."><br><br><br><br>
            Senha: <br>
            <input type="password" name="password" placeholder="Senha..."><br><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
        <br><br><br>
        <p class="text-center">TCC 2021 - FEMA. Paolo Antonio Spera Neto | 3°ADS</p>


    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['user_check'] = $username;
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['login_fail'] = "<div class='error_login text-center'><p>Nome de Usuário ou Senha Inválidos.</p></div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}



?>