<?php

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !=""){
        $path = "../images/category/".$image_name;
        $remove = unlink($path);

        if($remove==false){
            $_SESSION['remove_image'] = "<div class='error'><p>Erro: Falha: Imagem da Categoria não Removida.</p></div>";
            header('location:'.SITEURL.'admin/manage_category.php');
            die();

        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete_category'] = "<div class='sucess_delete'><p>Sucesso: Categoria Deletado.</p></div>";
        header('location:'.SITEURL.'admin/manage_category.php');
    }
    else{
        $_SESSION['delete_category'] = "<div class='error'><p>Erro: Falha ao Deletar a Categoria.</p></div>";
        header('location:'.SITEURL.'admin/manage_category.php');
    }
}
else{
    $_SESSION['unauthorize'] = "<div class='error'><p>Erro: Acesso não Autorizado.</p></div>";
    header('location:'.SITEURL.'admin/manage_category.php');
}
?>
