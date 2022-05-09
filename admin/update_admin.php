<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">UPDATE ADMINISTRADOR</h1>
        <br><br>


        <?php

        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                header('location' . SITEURL . 'admin/manage_admin.php');
            }
        }

        ?>

        <form action="" method="POST">

            <table class="tbl-20">
                <tr>
                    <td>Nome Completo: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username' 
    WHERE id='$id'
    ";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {

        $_SESSION['update_msg'] = "<div class='sucess_add'><p>Sucesso: Admin Atualizado.</p></div>";
        header("location:" . SITEURL . 'admin/manage_admin.php');
    } else {

        $_SESSION['update_msg'] = "<div class='error'><p>Erro: Falha ao Atualizar o Admin.</p></div>";
        header("location:" . SITEURL . 'admin/update_admin.php');
    }
}

?>


<?php
include('partials/footer.php');
?>