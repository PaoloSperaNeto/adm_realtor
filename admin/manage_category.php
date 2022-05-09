<?php
include('partials/menu.php');
?>


<!--main-->
<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">GERENCIADOR DAS CATEGORIAS DE IMÓVEIS</h1>

    <br /><br />
    <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn-primary">Adicionar</a>
    <br /><br /><br />


    <?php
    if (isset($_SESSION['add_category'])) {
      echo $_SESSION['add_category'];
      unset($_SESSION['add_category']);
    }

    if (isset($_SESSION['remove_image'])) {
      echo $_SESSION['remove_image'];
      unset($_SESSION['remove_image']);
    }

    if (isset($_SESSION['delete_category'])) {
      echo $_SESSION['delete_category'];
      unset($_SESSION['delete_category']);
    }

    if (isset($_SESSION['no_category_found'])) {
      echo $_SESSION['no_category_found'];
      unset($_SESSION['no_category_found']);
    }

    if (isset($_SESSION['update_category'])) {
      echo $_SESSION['update_category'];
      unset($_SESSION['update_category']);
    }

    if (isset($_SESSION['upload_error'])) {
      echo $_SESSION['upload_error'];
      unset($_SESSION['upload_error']);
    }

    if (isset($_SESSION['remove_img_error'])) {
      echo $_SESSION['remove_img_error'];
      unset($_SESSION['remove_img_error']);
    }

    if (isset($_SESSION['unauthorize'])) {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }

    ?>

    <table class="tbl-full">
      <tr>
        <th class="text-center">Número de Série</th>
        <th class="text-center">Nome da Categoria</th>
        <th class="text-center">Imagem</th>
        <th class="text-center">Apresentação</th>
        <th class="text-center">Ativação</th>
        <th class="text-center">Sistema</th>
      </tr>

      <?php
      $sql = "SELECT * FROM tbl_category";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      $sn = 1;
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];

      ?>
          <tr class="text-center">
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>

            <td>
              <?php

              if ($image_name != "") {
              ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
              <?php
              } else {
                echo "<div class='error_img'>Imagem não Encontrada.</div>";
              }
              ?>

            </td>
            <td><?php echo $featured ?></td>
            <td><?php echo $active ?></td>
            <td>
              <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar</a>
              <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Deletar</a>
            </td>
          </tr>
        <?php

        }
      } else {
        ?>
        <tr>
          <td colspan="6">
            <div class="error">
              <p>Nenhuma Categoria Adicionada</p>
            </div>

          </td>
        </tr>
      <?php
      }

      ?>

    </table>

  </div>
</div>

<!--end main-->

<?php
include('partials/footer.php');
?>