<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ALTERAR SENHA</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-20">
                <tr>
                    <td>Senha Atual: </td>
                    <td><input type="password" name="current_password" placeholder="Senha Atual..."></td>
                </tr>

                <tr>
                    <td>Nova Senha: </td>
                    <td><input type="password" name="new_password" placeholder="Nova Senha..."></td>
                </tr>

                <tr>
                    <td>Confirmar Senha: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirmar Nova Senha..."></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Alterar Senha" class="btn-other">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            if ($new_password == $confirm_password) {

                $sql2 = "UPDATE tbl_admin SET 
                password='$new_password' 
                WHERE id=$id     
                ";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == TRUE) {

                    $_SESSION['sucess_password_change'] = "<div class='sucess_add'><p>Sucesso: Senha Alterada.</p></div>";
                    header("location:" . SITEURL . 'admin/manage_admin.php');
                } else {
                    $_SESSION['error_password_msg'] = "<div class='error'><p>Senha Atual não Condiz.</p></div>";
                    header("location:" . SITEURL . 'admin/manage_admin.php');
                }
            } else {
                $_SESSION['error_password_msg'] = "<div class='error'><p>Senha Atual não Condiz.</p></div>";
                header("location:" . SITEURL . 'admin/manage_admin.php');
            }
        } else {
            $_SESSION['error_user_password_msg'] = "<div class='error'><p>Usuário ou Senha Inválido.</p></div>";
            header("location:" . SITEURL . 'admin/manage_admin.php');
        }
    }
}
?>


<?php
include('partials/footer.php');
?>