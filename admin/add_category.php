<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ADICIONAR CATEGORIA DE IMÓVEIS</h1>
        <br><br><br>

        <?php
        if (isset($_SESSION['add_category'])) {
            echo $_SESSION['add_category'];
            unset($_SESSION['add_category']);
        }
        ?>

        <?php
        if (isset($_SESSION['upload_error'])) {
            echo $_SESSION['upload_error'];
            unset($_SESSION['upload_error']);
        }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-20">
                <tr>
                    <td>Nova Categoria: </td>
                    <td>
                        <input type="text" name="title" placeholder="Nome da Categoria...">
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
            $image_name = "Property_Category" . rand(000, 999) . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                $_SESSION['upload_error'] = "<div class='error'><p>Erro: Falha no Upload da Imagem.</p></div>";
                header("location:" . SITEURL . 'admin/add_category.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }
    $sql = "INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
        ";

    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {

        $_SESSION['add_category'] = "<div class='sucess_add'><p>Sucesso: Categoria Adicionada.</p></div>";
        header("location:" . SITEURL . 'admin/manage_category.php');
    } else {

        $_SESSION['add_category'] = "<div class='error'><p>Erro: Falha ao Adicionar Categoria.</p></div>";
        header("location:" . SITEURL . 'admin/add_category.php');
    }
}
?>