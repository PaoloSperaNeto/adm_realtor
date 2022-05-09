<?php
include('partials/menu.php');
?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">GERENCIADOR DE ADMINS</h1>

    <br><br>
    <a href="add_admin.php" class="btn-primary">Adicionar</a>
    <br><br><br>

    <?php
    if (isset($_SESSION['add_msg'])) {
      echo $_SESSION['add_msg'];
      unset($_SESSION['add_msg']);
    }
    if (isset($_SESSION['delete_admin'])) {
      echo $_SESSION['delete_admin'];
      unset($_SESSION['delete_admin']);
    }

    if (isset($_SESSION['update_msg'])) {
      echo $_SESSION['update_msg'];
      unset($_SESSION['update_msg']);
    }

    if (isset($_SESSION['error_user_password_msg'])) {
      echo $_SESSION['error_user_password_msg'];
      unset($_SESSION['error_user_password_msg']);
    }

    if (isset($_SESSION['error_password_msg'])) {
      echo $_SESSION['error_password_msg'];
      unset($_SESSION['error_password_msg']);
    }

    if (isset($_SESSION['sucess_password_change'])) {
      echo $_SESSION['sucess_password_change'];
      unset($_SESSION['sucess_password_change']);
    }


    ?>

    <table class="tbl-full">
      <tr>
        <th class="text-center">Número de Série</th>
        <th class="text-center">Nome Completo</th>
        <th class="text-center">Usuário</th>
        <th class="text-center">Sistema</th>
      </tr>

      <?php

      $sql = "SELECT * FROM tbl_admin";

      $res = mysqli_query($conn, $sql);

      if ($res == TRUE) {

        $count = mysqli_num_rows($res);

        $sn = 1; 

        if ($count > 0) {


          while ($rows = mysqli_fetch_assoc($res)) {
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

      ?>
            <tr class="text-center">
              <td><?php echo $sn++ ?></td>
              <td><?php echo $full_name ?></td>
              <td><?php echo $username ?></td>
              <td>
                <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar</a>
                <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-other">Senha</a>
                <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Deletar</a>
              </td>
            </tr>
      <?php

          }
        }
      }


      ?>

    </table>

  </div>
</div>


<?php
include('partials/footer.php');
?>