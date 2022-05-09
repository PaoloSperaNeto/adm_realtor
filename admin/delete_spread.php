<?php 

    include('../config/constants.php');
    
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_spread WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete_spread'] = "<div class='sucess_delete'><p>Sucesso: Agendamento Deletado.</p></div>";
        header('location:'.SITEURL.'admin/manage_spread.php');
    }
    else{
        $_SESSION['delete_spread'] = "<div class='error'><p>Erro: Falha ao Deletar o Agendamento.</p></div>";
        header('location:'.SITEURL.'admin/manage_spread.php');
    }

?>