<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ADICIONAR IMÓVEL</h1>
        <br><br><br>

        <?php
        if (isset($_SESSION['upload_error'])) {
            echo $_SESSION['upload_error'];
            unset($_SESSION['upload_error']);
        }

        if (isset($_SESSION['add_property'])) {
            echo $_SESSION['add_property'];
            unset($_SESSION['add_property']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-20">
                <tr>
                    <td>Novo Imóvel: </td>
                    <td>
                        <input type="text" name="title" placeholder="Título ...">
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="Descrição do Imóvel..." spellcheck="true"></textarea>
                    </td>
                </tr>

                <tr>

                    <td>Categoria: </td>
                    <td>
                        <select name="category">>

                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Sim'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">Nenhuma Categoria Cadastrada</option>
                            <?php
                            }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Apresentação: </td>
                    <td>
                        <input type="radio" name="featured" value="Sim">Sim
                        <input type="radio" name="featured" value="Não">Não
                    </td>
                </tr>

                <tr>
                    <td>Ativação: </td>
                    <td>
                        <input type="radio" name="active" value="Sim">Sim
                        <input type="radio" name="active" value="Não">Não
                    </td>
                </tr>

                <tr>
                    <td>Upload da Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
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

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];


    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "Não";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "Não";
    }

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = end(explode('.', $image_name));
            $image_name = "Property_Photo" . rand(000, 999) . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/property/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                $_SESSION['upload_error'] = "<div class='error'><p>Erro: Falha no Upload da Imagem.</p></div>";
                header("location:" . SITEURL . 'admin/add_property.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }

    $sql2 = "INSERT INTO tbl_property SET 
    title = '$title',
    category_id = $category,
    description = '$description',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['add_property'] = "<div class='sucess_add'><p>Sucesso: Imóvel Adicionado.</p></div>";
        header("location:" . SITEURL . 'admin/manage_property.php');
    } else {
        $_SESSION['add_property'] = "<div class='error'><p>Erro: Falha ao Adicionar Imóvel.</p></div>";
        header("location:" . SITEURL . 'admin/add_property.php');
    }
}

?>