<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>


<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php if ($sale!=null){?>
            <div class="item-slick1 item1-slick1" style="background-image: url(<?= Url::to('@web/images/products/'.$sale[0]['idprodutos'].'/'.$sale[0]['produtoImagem1']) ?>);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale" style="background-color:rgba(0, 0, 0, 0.3); ">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
                            <?= $sale[0]['campanhaNome']?>
                        </h2>
                        <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
                            Up to <?= $sale[0]['qntProdutos'] ?> items with discounts!<br>
    						Take advantage until <b><?= $sale[0]['campanhaDataFim'] ?></b>
    					</span>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                            <!-- Button -->
                            <a href="<?php echo Url::to(['/campanha/produtocampanha'])?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Take a look
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>

            <?php if($bestSeller!=null){ ?>
            <div class="item-slick1 item2-slick1" style="background-image: url(<?= Url::to('@web/images/products/'.$bestSeller[0]['idprodutos'].'/'.$bestSeller[0]['produtoImagem1']) ?>);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelbest" style="background-color:rgba(0, 0, 0, 0.3); ">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
                            <?= $bestSeller[0]['produtoNome'] ?>
                        </h2>

                            <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
                                <?= $bestSeller[0]['qntCompras'] ?> units sold!
                                <br>
                                For just <b>
                                    <?php
                                    if ($bestSeller[0]['precoDpsDesconto']==null){
                                        echo $bestSeller[0]['produtoPreco'].'€';
                                    }
                                    else
                                    {
                                        echo '
                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$bestSeller[0]['produtoPreco'].'€
                                        </span>
    
                                        <span class="block2-newprice m-text8 p-r-5" style="color: white;">
    											'.$bestSeller[0]['precoDpsDesconto'].'€
									    </span>
                                    ';
                                    }
                                        ?>
                                    </b>
                            </span>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
                            <!-- Button -->
                            <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if($new!=null){?>

            <div class="item-slick1 item3-slick1" style="background-image: url(<?= Url::to('@web/images/products/'.$new[0]['idprodutos'].'/'.$new[0]['produtoImagem1']) ?>);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew" style="background-color:rgba(0, 0, 0, 0.3); ">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
                            <?= $new[0]['produtoNome'] ?>
                        </h2>

                            <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
                                For just <b>
                                    <?php
                                    if ($new[0]['precoDpsDesconto']==null){
                                        echo $new[0]['produtoPreco'].'€';
                                    }
                                    else
                                    {
                                        echo '
                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$new[0]['produtoPreco'].'€
                                        </span>
    
                                        <span class="block2-newprice m-text8 p-r-5" style="color: white;">
    											'.$new[0]['precoDpsDesconto'].'€
									    </span>
                                    ';
                                    }
                                    ?>
                                    </b>
                            </span>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
                            <!-- Button -->
                            <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>


        </div>
    </div>
</section>

<!-- Banner -->
<?php if($categoryRow!=null){?>
<div class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="sec-title p-b-22">
            <h3 class="m-text5 t-center">
                Featured categories
            </h3>
        </div>
        <div class="row">
            <?php
            foreach ($categoryRow as $eachCategory)
                {
                    echo'
                         <div class="col-sm-10 col-md-4 col-lg-4 m-l-r-left">
                            <!-- block1 -->
                            <div class="block1 hov-img-zoom pos-relative m-b-30">';
                            $imgPath = Url::to('@web/images/products/'.$eachCategory['idprodutos'].'/'.$eachCategory['produtoImagem1']);
                            echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
    
                                echo '<div class="block1-wrapbtn w-size2">
                                    <!-- Button -->
                                    <a href="'.Url::to(['produto/index', 'categoriaChild' =>  $eachCategory['idchild']]).'" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                        '.$eachCategory['childNome'].'
                                    </a>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
        </div>
    </div>
</div>
<?php } ?>

<!-- Our product -->
<section class="bgwhite p-t-45 p-b-58">
    <div class="container">
        <div class="sec-title p-b-22">
            <h3 class="m-text5 t-center">
                Our Products
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['produto/index']) ?>" role="tab"><b><span style="color: #352bfe;">All</span></b></a>
                </li>
                <?php
                    if ($bestSeller!=null or !isset($bestSeller))
                    {
                     echo '
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
                        </li>
                     ';
                    }

                    if ($recent!=null or !isset($recent))
                    {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link '.(($bestSeller==null) ? 'active' : null) .'" data-toggle="tab" href="#new" role="tab">Recent</a>
                            </li>';
                    }

                    if ($productSale!=null or !isset($productSale))
                    {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link '.(($recent==null) ? 'active' : null) .'" data-toggle="tab" href="#sale" role="tab">Sale</a>
                                </li>';
                    }

                    if ($recentBuy!=null or !isset($recentBuy))
                    {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link '.(($productSale==null) ? 'active' : null) .'" data-toggle="tab" href="#top-rate" role="tab">Recently Bought</a>
                                </li>';
                    }
                ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-35">
                <!-- - -->
                <div class="tab-pane fade <?= (($bestSeller!=null) ? "show active" : null) ?>" id="best-seller" role="tabpanel">
                    <div class="row">
                        <?php
                            foreach ($bestSeller as $eachBest)
                            {
                                echo '
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                        ';
                                        if ($eachBest['campanhaPercentagem']==null)
                                        {
                                            echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-label">';
                                        }
                                        elseif ($eachBest['campanhaPercentagem']!=null)
                                        {
                                            echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">';

                                        }
                                        $imgPath = Url::to('@web/images/products/'.$eachBest['idprodutos'].'/'.$eachBest['produtoImagem1']);
                                echo '<div class="imageResizeIndex">';
                                echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                                echo '</div>';
                                        echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachBest['idprodutos']]).'">
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.Url::to(['produto/view', 'id' => $eachBest['idprodutos']]).'" class="block2-name dis-block s-text3 p-b-5">
                                        '.$eachBest['produtoNome'].'
                                    </a>';
                                    echo $eachBest['qntCompras'].' sold <br>';
                                    if ($eachBest['precoDpsDesconto']==null)
                                    {
                                        echo '
                                        										<span class="block2-price m-text6 p-r-5">
											'.$eachBest['produtoPreco'].'€
										</span>
                                        ';
                                    }
                                    else
                                    {
                                    echo '
                                                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$eachBest['produtoPreco'].'€
                                    </span>

                                    <span class="block2-newprice m-text8 p-r-5">
											'.$eachBest['precoDpsDesconto'].'€
									</span>
                                    ';
                                    }echo'
                                </div>
                            </div>
                        </div>
                                ';
                            }
                        ?>

                    </div>
                </div>

                <!-- - -->
                <div class="tab-pane fade <?= (($bestSeller==null) ? "show active" : null)?>" id="new" role="tabpanel">
                    <div class="row">
                        <?php
                        foreach ($recent as $eachRecent)
                        {
                            echo '
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                        ';
                            if ($eachRecent['campanhaPercentagem']==null)
                            {
                                echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-label">';
                            }
                            elseif ($eachRecent['campanhaPercentagem']!=null)
                            {
                                echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">';

                            }
                            $imgPath = Url::to('@web/images/products/'.$eachRecent['idprodutos'].'/'.$eachRecent['produtoImagem1']);
                            echo '<div class="imageResizeIndex">';
                            echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                            echo '</div>';
                            echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachRecent['idprodutos']]).'">
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.Url::to(['produto/view', 'id' => $eachRecent['idprodutos']]).'" class="block2-name dis-block s-text3 p-b-5">
                                        '.$eachRecent['produtoNome'].'
                                    </a>';
                            if ($eachRecent['precoDpsDesconto']==null)
                            {
                                echo '
                                        										<span class="block2-price m-text6 p-r-5">
											'.$eachRecent['produtoPreco'].'€
										</span>
                                        ';
                            }
                            else
                            {
                                echo '
                                                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$eachRecent['produtoPreco'].'€
                                    </span>

                                    <span class="block2-newprice m-text8 p-r-5">
											'.$eachRecent['precoDpsDesconto'].'€
									</span>
                                    ';
                            }echo'
                                </div>
                            </div>
                        </div>
                                
                                
                                
                                ';
                        }
                        ?>
                    </div>
                </div>

                <!--  -->
                <div class="tab-pane fade <?= (($recent==null) ? "show active" : null)?>" id="sale" role="tabpanel">
                    <div class="row">
                        <?php
                        foreach ($productSale as $eachProductSale)
                        {
                            echo '
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                        ';
                                echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">';

                            $imgPath = Url::to('@web/images/products/'.$eachProductSale['idprodutos'].'/'.$eachProductSale['produtoImagem1']);
                            echo '<div class="imageResizeIndex">';
                            echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                            echo'</div>';
                            echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachProductSale['idprodutos']]).'">
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.Url::to(['produto/view', 'id' => $eachProductSale['idprodutos']]).'" class="block2-name dis-block s-text3 p-b-5">
                                        '.$eachProductSale['produtoNome'].'
                                    </a>';
                                  echo '
                                                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$eachProductSale['produtoPreco'].'€
                                    </span>

                                    <span class="block2-newprice m-text8 p-r-5">
											'.$eachProductSale['precoDpsDesconto'].'€
									</span>
                                    ';
                            echo'
                                </div>
                            </div>
                        </div>
                                
                                
                                
                                ';
                        }
                        ?>
                    </div>
                </div>

                <!--  -->
                <div class="tab-pane fade <?= (($productSale==null) ? "show active" : null)?>" id="top-rate" role="tabpanel">
                    <div class="row">
                        <?php
                        foreach ($recentBuy as $eachRecentBuy)
                        {
                            echo '
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                        ';
                            if ($eachRecentBuy['campanhaPercentagem']==null)
                            {
                                echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-label">';
                            }
                            elseif ($eachRecentBuy['campanhaPercentagem']!=null)
                            {
                                echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">';

                            }
                            $imgPath = Url::to('@web/images/products/'.$eachRecentBuy['idprodutos'].'/'.$eachRecentBuy['produtoImagem1']);
                            echo '<div class="imageResizeIndex">';
                            echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                            echo '</div>';
                            echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachRecentBuy['idprodutos']]).'">
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.Url::to(['produto/view', 'id' => $eachRecentBuy['idprodutos']]).'" class="block2-name dis-block s-text3 p-b-5">
                                        '.$eachRecentBuy['produtoNome'].'
                                    </a>';
                            if ($eachRecentBuy['precoDpsDesconto']==null)
                            {
                                echo '
                                        										<span class="block2-price m-text6 p-r-5">
											'.$eachRecentBuy['produtoPreco'].'€
										</span>
                                        ';
                            }
                            else
                            {
                                echo '
                                                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$eachRecentBuy['produtoPreco'].'€
                                    </span>

                                    <span class="block2-newprice m-text8 p-r-5">
											'.$eachRecentBuy['precoDpsDesconto'].'€
									</span>
                                    ';
                            }echo'
                                </div>
                            </div>
                        </div>
                                ';
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Current sales -->
<?php if ($sale!=null){?>
<section class="blog bgwhite p-t-94 p-b-65">
    <div class="container">
        <div class="sec-title p-b-52">
            <h3 class="m-text5 t-center">
                Current Sales
            </h3>
        </div>
        <div class="row">
            <?php

            foreach ($sale as $eachSale)
            {
                echo '
                    <div class="col-sm-10 col-md-4 p-b-30 m-l-r-left">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">';
                                $imgPath = Url::to('@web/images/products/'.$eachSale['idprodutos'].'/'.$eachSale['produtoImagem1']);
                                
                                echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                       echo'</a>
        
                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        '.$eachSale['campanhaNome'].'
                                    </a>
                                </h4>
                                <p><span class="s-text6">up to </span><b><span class="s-text7">'.$eachSale['qntProdutos'].'</span><span> items</b> with discounts!</span></p>
                                <span class="s-text6">from</span> <span class="s-text7">'.$eachSale['campanhaDataInicio'].'</span>
                                <span class="s-text6">until</span> <span class="s-text7">'.$eachSale['campanhaDataFim'].'</span>
        
                                <p class="s-text8 p-t-16">
                                        '.$eachSale['campanhaDescricao'].'
                                </p>
                            </div>
                        </div>
                    </div>
                ';
            }
            ?>


        </div>
    </div>
</section>
<?php }?>
<!-- Shipping -->
<section class="shipping bgwhite p-t-62 p-b-46">

</section>






<!-- Back to top -->

<!--===============================================================================================-->
