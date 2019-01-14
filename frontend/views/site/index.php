<?php



    use yii\helpers\Html;
    use yii\helpers\Url;
?>


<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php if ($sale!=null){?>
            <div class="item-slick1 item1-slick1" style="background-image: url(images/master-slide-07.jpg);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
                            <?= $sale[0]['campanhaNome']?>
                        </h2>
                        <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
                            Up to <?= $sale[0]['qntProdutos'] ?> items<br>
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

            <div class="item-slick1 item2-slick1" style="background-image: url(<?= Url::to('@web/images/products/'.$bestSeller[0]['idprodutos'].'/'.$bestSeller[0]['produtoImagem1']) ?>);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelbest">
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
                                    </b> each
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

            <div class="item-slick1 item3-slick1" style="background-image: url(images/master-slide-02.jpg);">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
                            Leather Bags
                        </h2>

                            <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
                                New Collection 2018
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

        </div>
    </div>
</section>

<!-- Banner -->
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
                         <div class="col-sm-10 col-md-4 col-lg-4 m-l-r-auto">
                            <!-- block1 -->
                            <div class="block1 hov-img-zoom pos-relative m-b-30">';
                            $imgPath = Url::to('@web/images/products/'.$eachCategory['idprodutos'].'/'.$eachCategory['imagem1']);
                            echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
    
                                echo '<div class="block1-wrapbtn w-size2">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
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
                <?php
                    if ($bestSeller!=null or !isset($bestSeller))
                    {
                     echo '
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
                        </li>
                     ';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#featured" role="tab">New</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sale" role="tab">Sale</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#top-rate" role="tab">Recently Bought</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-35">
                <!-- - -->
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
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
                                        echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                                        echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                            Add to Cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
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
                <div class="tab-pane fade" id="featured" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-07.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Frayed denim shorts
                                    </a>

										<span class="block2-oldprice m-text7 p-r-5">
											$29.50
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											$15.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/item-01.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-14.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/item-06.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-11.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Frayed denim shorts
                                    </a>

										<span class="block2-oldprice m-text7 p-r-5">
											$29.50
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											$15.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/item-12.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-15.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="tab-pane fade" id="sale" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-01.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-14.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-06.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-08.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="tab-pane fade" id="top-rate" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/item-02.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-03.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-05.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Coach slim easton black
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$165.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-07.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Frayed denim shorts
                                    </a>

										<span class="block2-oldprice m-text7 p-r-5">
											$29.50
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											$15.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-10.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Coach slim easton black
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$165.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                    <img src="images/item-11.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Frayed denim shorts
                                    </a>

										<span class="block2-oldprice m-text7 p-r-5">
											$29.50
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											$15.90
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/item-12.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Herschel supply co 25l
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$75.00
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img src="images/item-15.jpg" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                        Denim jacket blue
                                    </a>

										<span class="block2-price m-text6 p-r-5">
											$92.50
										</span>
                                </div>
                            </div>
                        </div>
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
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="images/blog-01.jpg" alt="IMG-BLOG">
                            </a>
        
                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        '.$eachSale['campanhaNome'].'
                                    </a>
                                </h4>
        
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


<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="t-center p-l-15 p-r-15">
        <div class="t-center p-l-15 p-r-15">
            <a href="#">
                <img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
            </a>
        <div class="t-center s-text8 p-t-20">
            Copyright � 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        </div>
    </div>
</footer>
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>


<!-- Back to top -->




<!--===============================================================================================-->
