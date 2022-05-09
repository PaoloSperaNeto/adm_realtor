<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">ATUALIZAR DIVULGAÇÕES</h1>
        <br><br><br>
        
 <?php
    if (isset($_SESSION['update_spread'])) {
      echo $_SESSION['update_spread'];
      unset($_SESSION['update_spread']);
    }
?>

<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql = "SELECT * FROM tbl_spread WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1){
            $rows = mysqli_fetch_assoc($res);
            $spread_date = $rows['spread_date'];
            $spread_time = $rows['spread_time'];
            $status = $rows['status'];
            $customer_name = $rows['customer_name'];
            $customer_phone = $rows['customer_phone'];
            $customer_email = $rows['customer_email'];

        }
        else{
            header('location:'.SITEURL.'admin/manage_spread.php');
        }
    }
    else{
        header('location:'.SITEURL.'admin/manage_spread.php');
    }

?>

        <form action="" method="POST">

        <table class="tbl-20">
            <tr>
                <td>Data</td>
                <td><?php echo $spread_date;?></td>
            </tr>

            <tr>
                <td>Horário</td>
                <td><?php echo $spread_time;?></td>
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
        $sql_submit = "UPDATE tbl_spread SET status = '$status' WHERE id=$id";
        $res_submit = mysqli_query($conn, $sql_submit);

        if($res_submit == TRUE){
            $_SESSION['update_spread'] = "<div class='sucess_add'><p>Sucesso: Agendamento Atualizado.</p></div>";
            header("location:" . SITEURL . 'admin/manage_spread.php');
        }
        else{
            $_SESSION['update_spread'] = "<div class='error'><p>Erro: Falha ao Atualizar a Categoria.</p></div>";
            header("location:" . SITEURL . 'admin/update_spread.php');
        }
    }

?>


    </div>
</div>

<?php
include('partials/footer.php');
?>