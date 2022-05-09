<?php
include('partials/menu.php');
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['no_category_found'] = "<div class='error'><p>Erro: Categoria Não Encontrada.</p></div>";
        header("location:" . SITEURL . 'admin/manage_category.php');
    }
} else {
    header('location' . SITEURL . 'admin/manage_category.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ATUALIZAR CATEGORIA DE IMÓVEIS</h1>
        <br><br><br>

        <?php
        if (isset($_SESSION['update_category'])) {
            echo $_SESSION['update_category'];
            unset($_SESSION['update_category']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-20">
                <tr>
                    <td>Atualizar Categoria: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Imagem Atual: </td>
                    <td>
                        <?php
                        if ($current_image != "") {

                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php


                        } else {
                            echo "<div class='error_img'>Imagem não Encontrada.</div>";
                        }


                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Apresentação: </td>
                    <td>
                        <input <?php if ($featured == "Sim") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Sim">Sim


                        <input <?php if ($featured == "Não") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Não">Não
                    </td>
                </tr>

                <tr>
                    <td>Ativação: </td>
                    <td>
                        <input <?php if ($active == "Sim") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Sim">Sim

                        <input <?php if ($active == "Não") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Não">Não
                    </td>
                </tr>

                <tr>
                    <td>Nova Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Atualizar" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    $ext = end(explode('.', $image_name));
                    $image_name = "Property_Category" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['upload_error'] = "<div class='error'><p>Erro: Falha no Upload da Imagem.</p></div>";
                        header("location:" . SITEURL . 'admin/manage_category.php');
                        die();
                    }
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == FALSE) {
                            $_SESSION['remove_img_error'] = "<div class='error'><p>Erro: Falha na Remoção da Imagem.</p></div>";
                            header("location:" . SITEURL . 'admin/manage_category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            }

            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE id='$id'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['update_category'] = "<div class='sucess_add'><p>Sucesso: Categoria Atualizada.</p></div>";
                header("location:" . SITEURL . 'admin/manage_category.php');
            } else {
                $_SESSION['update_category'] = "<div class='error'><p>Erro: Falha ao Atualizar a Categoria.</p></div>";
                header("location:" . SITEURL . 'admin/update_category.php');
            }
        }



        ?>
    </div>
</div>

<?php
include('partials/footer.php');
?>