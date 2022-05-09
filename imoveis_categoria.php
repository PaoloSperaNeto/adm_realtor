<?php include('partials_front/menu.php'); ?>

<section class="imovel-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>imoveis_busca.php" method="POST">
            <input type="search" name="search" placeholder="Busca de Imóveis...">
            <input type="submit" name="submit" value="Buscar" class="btn-busca-imovel btn-busca-imovel-primary">
        </form>
    </div>
</section>

<?php

    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else{
        header('location:'.SITEURL);
    }

?>

<section class="show">
    <div class="container">
        <h6 class="text-center text-white">Categoria de Imóveis</h6><br><br><h6 class="text-center"><?php echo $category_title?></h6><br><br>
        <br><br><br>

        <?php
            
            $sql2 = "SELECT * FROM tbl_property WHERE category_id=$category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0){
                while ($row2 = mysqli_fetch_assoc($res2)) 
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    
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
                echo "<div class='error'><p>Categoria Sem Imóveis Cadastrados.</p></div>";
            }

        ?>






        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials_front/footer.php'); ?>