<?php include('partials_front/menu.php'); ?>



<section class="imovel-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>imoveis_busca.php" method="POST">
            <input type="search" name="search" placeholder="Busca de Imóveis...">
            <input type="submit" name="submit" value="Buscar" class="btn-busca-imovel btn-busca-imovel-primary">
        </form>

    </div>
</section>



<section class="category">
    <div class="container">
    <?php 
    if(isset($_SESSION['scheduling_msg'])){
        echo $_SESSION['scheduling_msg'];
        unset($_SESSION['scheduling_msg']);
    }
    if(isset($_SESSION['spread_msg'])){
        echo $_SESSION['spread_msg'];
        unset($_SESSION['spread_msg']);
    }
    ?>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE featured='Sim' AND active='Sim' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php SITEURL; ?>imoveis_categoria.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'><p>Erro: Imagem não Encontrada.</p></div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt=<?php echo $title; ?> class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php

            }
        } else {
            echo "<div class='error'><p>Erro: Categoria Não Encontrada.</p></div>";
        }

        ?>


        <div class="clearfix"></div>

    </div>
</section>




    <section class="show">
        <div class="container">
            <h2 class="text-white text-center">Em Destaque</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_property WHERE active='Sim' AND featured='Sim' LIMIT 4";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                
                if($count2>0){
                    while($row=mysqli_fetch_assoc($res2)){
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
                        <p class="show-imoveis-anuncio">
                        <br>
                        Aluguel ou Venda
                        <br>
                        </p>
                        <br>
                        <p>
                        <strong>Descrição:</strong> <?php echo $description;?>
                        </p>
                        <br>
                        <p>
                        <br>
                        <strong>Localidade: Assis/SP</strong>
                        </p>
                    </div>
                <div class="clearfix"></div>
                </div>

                <?php
                    }

                }
                else{
                    echo "<div class='error'><p>Erro: Imóvel Não Encontrado.</p></div>";
                }
                ?>
            <div class="clearfix"></div>
        </div>
    </section>
        

<?php include('partials_front/footer.php'); ?>