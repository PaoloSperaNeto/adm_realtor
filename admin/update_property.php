<?php
include('partials/menu.php');
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_property WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $current_category = $row['category_id'];
        $title = $row['title'];
        $description = $row['description'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
    else {
        $_SESSION['no_property_found'] = "<div class='error'><p>Erro: Imóvel Não Encontrada.</p></div>";
        header("location:" . SITEURL . 'admin/manage_property.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage_property.php');
}


?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ATUALIZAR IMÓVEL</h1>
        <br><br><br>

        <?php
        if (isset($_SESSION['update_property'])) {
            echo $_SESSION['update_property'];
            unset($_SESSION['update_property']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-20">

                <tr>
                    <td>Atualizar Imóvel: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="Descrição do Imóvel..." spellcheck="true"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Imagem Atual: </td>
                    <td>
                        <?php
                        if ($current_image != "") {

                        ?>
                            <img src="<?php echo SITEURL; ?>images/property/<?php echo $current_image; ?>" alt="<?php echo $title;?>" width="150px">
                        <?php


                        } else {
                            echo "<div class='error_img'>Imagem não Encontrada.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <td>Categoria: </td>
                <td>
                    <select name="category_id">>
                        <?php
                        $sql_category = "SELECT * FROM tbl_category WHERE active='Sim'";

                        $res_category = mysqli_query($conn, $sql_category);

                        $count_category = mysqli_num_rows($res_category);

                        if ($count_category > 0) {
                            while ($row_category = mysqli_fetch_assoc($res_category)) {

                                $title_category = $row_category['title'];
                                $category_id = $row_category['id'];

                        ?>
                                <option <?php
                                        if ($current_category == $category_id) {
                                            echo 'selected';
                                        } ?> value="<?php echo $category_id; ?>"><?php echo $title_category; ?>
                                </option>
                        <?php

                            }
                        } else {
                            echo "<option value='0'> Nenhuma Categoria Cadastrada.</option>";
                        }
                        ?>
                    </select>
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
                        <input type="submit" name="submit" value="Atualizar" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category_id'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $current_image = $_POST['current_image'];


            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];


                if ($image_name != "") {

                    $ext = explode('.', $image_name);
                    $image_name = "Property_Photo" . rand(000, 999).'.jpg';
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/property/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'><p>Erro: Falha no Upload da Imagem.</p></div>";
                        header("location:" . SITEURL . 'admin/manage_property.php');
                        die();
                    }

                    if ($current_image != "") {
                        $remove_path = "../images/property/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == FALSE) {
                            $_SESSION['remove_error'] = "<div class='error'><p>Erro: Falha na Remoção da Imagem.</p></div>";
                            header("location:" . SITEURL . 'admin/manage_property.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            }

            $sql_update = "UPDATE tbl_property SET
                category_id = '$category',
                title = '$title',
                description = '$description',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE id='$id'
            ";

            $res_update = mysqli_query($conn, $sql_update);

            if ($res_update == TRUE) {
                $_SESSION['update_property'] = "<div class='sucess_add'><p>Sucesso: Imóvel Atualizado.</p></div>";
                header("location:" . SITEURL . 'admin/manage_property.php');
            } else {
                $_SESSION['update_property'] = "<div class='error'><p>Erro: Falha ao Atualizar o Imóvel.</p></div>";
                header("location:" . SITEURL . 'admin/update_property.php');
            }
        }

        ?>

    </div>
</div>

<?php
include('partials/footer.php');
?>