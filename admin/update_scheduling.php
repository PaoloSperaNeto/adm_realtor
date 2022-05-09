<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ATUALIZAR AGENDAMENTO</h1>
        <br><br><br>
        
 <?php
    if (isset($_SESSION['update_scheduling'])) {
      echo $_SESSION['update_scheduling'];
      unset($_SESSION['update_scheduling']);
    }
?>

<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql = "SELECT * FROM tbl_scheduling WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1){
            $rows = mysqli_fetch_assoc($res);

            $property_title = $rows['property_title'];
            $scheduling_date = $rows['scheduling_date'];
            $scheduling_time = $rows['scheduling_time'];
            $status = $rows['status'];
            $customer_name = $rows['customer_name'];
            $customer_phone = $rows['customer_phone'];
            $customer_email = $rows['customer_email'];

        }
        else{
            header('location:'.SITEURL.'admin/manage_scheduling.php');
        }
    }
    else{
        header('location:'.SITEURL.'admin/manage_scheduling.php');
    }

?>

        <form action="" method="POST">

        <table class="tbl-20">
            <tr>
                <td>Título do Imóvel</td>
                <td><?php echo $property_title;?></td>
            </tr>

            <tr>
                <td>Data</td>
                <td><?php echo $scheduling_date;?></td>
            </tr>

            <tr>
                <td>Horário</td>
                <td><?php echo $scheduling_time;?></td>
            </tr>

            <tr>
            <td>Cliente</td>
            <td><?php echo $customer_name;?></td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option <?php if($status=="Agendado"){echo "selected";}?>value="Agendado">Agendado</option>
                        <option <?php if($status=="Confirmado"){echo "selected";}?>value="Confirmado">Confirmado</option>
                        <option <?php if($status=="Cancelado!"){echo "selected";}?>value="Cancelado!">Cancelado!</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Atualizar" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql_submit = "UPDATE tbl_scheduling SET status = '$status' WHERE id=$id";
        $res_submit = mysqli_query($conn, $sql_submit);

        if($res_submit == TRUE){
            $_SESSION['update_scheduling'] = "<div class='sucess_add'><p>Sucesso: Agendamento Atualizado.</p></div>";
            header("location:" . SITEURL . 'admin/manage_scheduling.php');
        }
        else{
            $_SESSION['update_scheduling'] = "<div class='error'><p>Erro: Falha ao Atualizar a Categoria.</p></div>";
            header("location:" . SITEURL . 'admin/update_scheduling.php');
        }
    }

?>


    </div>
</div>

<?php
include('partials/footer.php');
?>