<?php

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !=""){
        $path = "../images/property/".$image_name;
        $remove = unlink($path);

        if($remove==false){
            $_SESSION['remove_image'] = "<div class='error'><p>Erro: Falha: Imagem do Imóvel não Removida.</p></div>";
            header('location:'.SITEURL.'admin/manage_property.php');
            die();

        }
    }

    $sql = "DELETE FROM tbl_property WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete_property'] = "<div class='sucess_delete'><p>Sucesso: Imóvel Deletado.</p></div>";
        header('location:'.SITEURL.'admin/manage_property.php');
    }
    else{
        $_SESSION['delete_property'] = "<div class='error'><p>Erro: Falha ao Deletar o Imóvel.</p></div>";
        header('location:'.SITEURL.'admin/manage_property.php');
    }
}
else{
    $_SESSION['unauthorize'] = "<div class='error'><p>Erro: Acesso não Autorizado.</p></div>";
    header('location:'.SITEURL.'admin/manage_property.php');
}
?>
