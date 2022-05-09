<?php
include('partials/menu.php');
?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center"><strong>GERENCIADOR DE AGENDAMENTOS</strong></h1>

    <br /><br />
    <br /><br /><br />
    <?php
    if (isset($_SESSION['update_scheduling'])) {
      echo $_SESSION['update_scheduling'];
      unset($_SESSION['update_scheduling']);
    }

    if (isset($_SESSION['delete_scheduling'])) {
      echo $_SESSION['delete_scheduling'];
      unset($_SESSION['delete_scheduling']);
    }
    ?>

    <table class="tbl-full">
      <tr>
        <th class="text-center">Título do Imóvel</th>
        <th class="text-center">Data do Agendamento</th>
        <th class="text-center">Horário do Agendamento</th>
        <th class="text-center">Status</th>
        <th class="text-center">Nome do Cliente</th>
        <th class="text-center">Telefone</th>
        <th class="text-center">Email</th>
        <th class="text-center">Sistema</th>
      </tr>

<?php
      $sql = "SELECT * FROM tbl_scheduling ORDER BY id DESC";

      $res = mysqli_query($conn, $sql);

      if ($res == TRUE) {

        $count = mysqli_num_rows($res);

        $sn = 1;

        if ($count > 0) {
          while ($rows = mysqli_fetch_assoc($res)) {
            $id = $rows['id'];
            $property_title = $rows['property_title'];
            $scheduling_date = $rows['scheduling_date'];
            $scheduling_time = $rows['scheduling_time'];
            $status = $rows['status'];
            $customer_name = $rows['customer_name'];
            $customer_phone = $rows['customer_phone'];
            $customer_email = $rows['customer_email'];
?>
            <tr class="text-center">
              <td><?php echo $property_title;?></td>
              <td><?php echo $scheduling_date;?></td>
              <td><?php echo $scheduling_time;?></td>
              <td><?php echo $status;?></td>
              <td><?php echo $customer_name;?></td>
              <td><?php echo $customer_phone;?></td>
              <td><?php echo $customer_email;?></td>
              <td>
                <a href="<?php echo SITEURL; ?>admin/update_scheduling.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar</a>
                <a href="<?php echo SITEURL; ?>admin/delete_scheduling.php?id=<?php echo $id; ?>" class="btn-danger">Deletar</a>
              </td>
            </tr>
      <?php

          }
        }
      }
?>

    </table>
    <div class="clearfix"></div>
  </div>
</div>

<?php
include('partials/footer.php');
?>