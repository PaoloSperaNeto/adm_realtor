<?php 

    include('../config/constants.php');
    
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_scheduling WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete_scheduling'] = "<div class='sucess_delete'><p>Sucesso: Agendamento Deletado.</p></div>";
        header('location:'.SITEURL.'admin/manage_scheduling.php');
    }
    else{
        $_SESSION['delete_scheduling'] = "<div class='error'><p>Erro: Falha ao Deletar o Agendamento.</p></div>";
        header('location:'.SITEURL.'admin/manage_scheduling.php');
    }

?>
