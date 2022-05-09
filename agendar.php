<?php include('partials_front/menu.php'); ?>

<?php 
    if(isset($_GET['property_id'])){
        $property_id = $_GET['property_id'];
        $sql = "SELECT * FROM tbl_property WHERE id=$property_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['description'];
            $image_name = $row['image_name'];
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>

<!--campo agendar-->
<section class="visitar-background">
    <div class="container backgroud-color-div img-curve">

        <h6 class="text-center">Agende sua Visita</h6>

        <form action="" method="POST" class="visitar">
            <fieldset class="backgroud-color-visitar-box">

                <div class="show-imoveis-img">
                    <?php
                        if($image_name==""){
                        echo "<div class='error'><p>Erro: Imagem não Encontrada.</p></div>";
                        }
                        else{
                    ?> 
                        <img src="<?php echo SITEURL; ?>images/property/<?php echo $image_name; ?>" alt="ImgDestaqueImovel" class="img-responsive img-curve">
                    <?php
                    }
                    ?> 
                </div>

                <div class="show-imoveis-desc">
                    <h4 class="show-imoveis-anuncio"><?php echo $title;?></h4>
                    <input type="hidden" name="property_title" value="<?php echo $title;?>">
                    <p class="show-imoveis-anuncio">
                        Aluguel ou Venda
                    </p>
                    <br>
                    <p>
                    <strong>Descrição:</strong> <?php echo $description;?>
                    </p>
                    <br>
                    <p>
                    <strong>Localidade: Assis/SP</strong>
                    </p>

                </div>
            </fieldset>
            <br>

            <fieldset class="backgroud-color-visitar-box">

                <div class="visitar-label">Nome Completo:</div>
                <input type="text" name="full-name" placeholder="obrigatório" class="input-responsive" required>

                <div class="visitar-label">Telefone:</div>
                <input type="tel" name="contact" placeholder="obrigatório" class="input-responsive" required>

                <div class="visitar-label">E-mail:</div>
                <input type="email" name="email" placeholder="obrigatório" class="input-responsive" required>

                <div class="visitar-label">Data da Visita:</div>
                <small>seg. a sex.</small>
                <input type="date" name="scheduling_date" class="input-responsive" required>

                <div class="visitar-label">Horário da Visita:</div>
                <small>9h00 às 17h00</small>
                <input type="time" name="scheduling_time" min="09:00" max="18:00" required class="input-responsive">


                <div class="visitar-label">Outras Informações:</div>
                <textarea name="info" rows="10" placeholder="Digite aqui:" class="input-responsive" required spellcheck></textarea>
                
                <input type="submit" name="submit" value="Agendar" class="btn-agendar-confirm">
            </fieldset>

<?php 
    if (isset($_POST['submit'])){
        $property_title = $_POST['property_title'];
        $scheduling_date = $_POST['scheduling_date'];
        $scheduling_time = $_POST['scheduling_time'];
        $status = "Agendado";
        $customer_name = $_POST['full-name'];
        $customer_phone = $_POST['contact'];
        $customer_email = $_POST['email'];
        $scheduling_text = $_POST['info'];

        $sql_submit = "INSERT INTO tbl_scheduling SET 
            property_title = '$property_title',
            scheduling_date = '$scheduling_date',
            scheduling_time = '$scheduling_time',
            status = '$status',
            customer_name = '$customer_name',
            customer_phone = '$customer_phone',
            customer_email = '$customer_email',
            scheduling_text = '$scheduling_text'
        ";

        
        $res_submit = mysqli_query($conn, $sql_submit);
        if($res_submit==true){
            $_SESSION['scheduling_msg'] = "<div class='sucess'><p>Agendamento Realizado.</p></div>";
            header('location:'.SITEURL);

        }
        else{
            $_SESSION['scheduling_msg'] = "<div class='error'><p>Erro ao realizar o Agendamento.</p></div>";
            header('location:'.SITEURL);
        }
    }


?>
    </div>
</section>



<?php include('partials_front/footer.php'); ?>