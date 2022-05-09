<?php 

    include('../config/constants.php');
    
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete_admin'] = "<div class='sucess_delete'><p>Sucesso: Admin Deletado.</p></div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else{
        $_SESSION['delete_admin'] = "<div class='error'><p>Erro: Falha ao Deletar o Admin.</p></div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }

?>
