<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ADICIONAR ADMINISTRADOR</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add_msg'])) {
            echo $_SESSION['add_msg'];
            unset($_SESSION['add_msg']);
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-20">
                <tr>
                    <td>Nome Completo: </td>
                    <td><input type="text" name="full_name" placeholder="Nome Completo..."></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Username..."></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Password..."></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


    </div>
</div>
<?php
include('partials/footer.php');
?>

<?php


if (isset($_POST['submit'])) {


    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'

        ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($myConnection));


    if ($res == TRUE) {

        $_SESSION['add_msg'] = "<div class='sucess_add'><p>Sucesso: Admin Adicionado.</p></div>";
        header("location:" . SITEURL . 'admin/manage_admin.php');
    } else {

        $_SESSION['add'] = "<div class='error'><p>Erro: Falha ao Adicionar o Admin.</p></div>";
        header("location:" . SITEURL . 'admin/add_admin.php');
    }
}

?>