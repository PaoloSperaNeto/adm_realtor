<?php include('partials_front/menu.php'); ?>

<section class="imovel-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>imoveis_busca.php" method="POST">
            <input type="search" name="search" placeholder="Busca de Imóveis...">
            <input type="submit" name="submit" value="Buscar" class="btn-busca-imovel btn-busca-imovel-primary">
        </form>

    </div>
</section>

<section class="show">
    <div class="container">
        <?php
        $search = $_POST['search'];
        ?>
        <h6 class="text-center text-white">Busca de Imóveis</h6><br><br><h6 class="text-center"><?php echo $search?></h6>
        <br><br><br>

        <?php
            
            $sql = "SELECT * FROM tbl_property WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0){
                while ($row = mysqli_fetch_assoc($res)) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    
                ?>
    
                    <div class="show-imoveis-box">
                        <a href="<?php SITEURL; ?>agendar.php?property_id=<?php echo $id ?>">
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
                        </a>
                            <div class="show-imoveis-desc">
                                <h4 class="show-imoveis-anuncio"><?php echo $title?></h4>
                                <p class="show-imoveis-anuncio">Aluguel ou Venda</p>
                                <br>
                                <p>
                                <strong>Descrição:</strong> <?php echo $description;?>
                                </p>
                                <br>
                                <p>
                                <strong>Localidade: Assis/SP</strong>
                                </p>
    
                            </div>
                        <div class="clearfix"></div>
                    </div>
                <?php
                }
            }
            else{
                echo "<div class='error'><p>Não encontramos nenhum Imóvel</p></div>";
            }

        ?>

        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials_front/footer.php'); ?>