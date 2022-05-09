<?php include('partials_front/menu.php'); ?>

<!--campo agendar-->
<section class="visitar-background">
    <div class="container backgroud-color-div img-curve">

        <h6 class="text-center">Vamos divulgar seu imóvel!</h6>
        <br><br><br>
        <h6 class="text-center text-white">Agende agora sua visita de Sucesso!</h6>
        <br>
        <form action="" method="POST" class="visitar">

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
                <input type="date" name="spread_date" class="input-responsive" required>

                <div class="visitar-label">Horário da Visita:</div>
                <small>9h00 às 17h00</small>
                <input type="time" name="spread_time" min="09:00" max="18:00" required class="input-responsive">


                <div class="visitar-label">Outras Informações:</div>
                <textarea name="info" rows="10" placeholder="Digite aqui:" class="input-responsive" required spellcheck></textarea>
                
                <input type="submit" name="submit" value="Agendar" class="btn-agendar-confirm">
            </fieldset>

<?php 
    if (isset($_POST['submit'])){
        //spread
        $spread_date = $_POST['spread_date'];
        $spread_time = $_POST['spread_time'];
        $status = "Divulgação Agendada";
        $customer_name = $_POST['full-name'];
        $customer_phone = $_POST['contact'];
        $customer_email = $_POST['email'];
        $spread_text = $_POST['info'];

        $sql_submit = "INSERT INTO tbl_spread SET 
            spread_date = '$spread_date',
            spread_time = '$spread_time',
            status = '$status',
            customer_name = '$customer_name',
            customer_phone = '$customer_phone',
            customer_email = '$customer_email',
            spread_text = '$spread_text'
        ";

        
        $res_submit = mysqli_query($conn, $sql_submit);
        if($res_submit==true){
            $_SESSION['spread_msg'] = "<div class='sucess'><p>Agendamento Realizado.</p></div>";
            header('location:'.SITEURL);

        }
        else{
            $_SESSION['spread_msg'] = "<div class='error'><p>Erro ao realizar o Agendamento.</p></div>";
            header('location:'.SITEURL);
        }
    }
?>
    </div>
</section>

<?php include('partials_front/footer.php'); ?>