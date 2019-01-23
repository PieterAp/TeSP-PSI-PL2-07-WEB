<!DOCTYPE html>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Product Detail -->
<div class="container bgwhite p-t-35">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        <?php
                        for ($i=1;$i<=4;$i++)
                        {
                            $image = 'produtoImagem'.$i;
                            if ($model[$image]!=null)
                            {
                                $imgPath = Url::to('@web/images/products/'.$model['idprodutos'].'/'.$model[$image]);
                                echo '
                                            <div class="item-slick3" data-thumb="'. Url::to($imgPath) .'" style="max-height: 668px; max-width: 501px;height: auto; ">
                                                <div class="wrap-pic-w">
                                                    '.Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']).'
                                                </div>
                                            </div>
                                        ';
                            }
                        }
                        ?>
                    </div>
            </div>
        </div>

        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text16 p-b-13">
                <?= $model['produtoNome'] ?>
            </h4>

            <span class="m-text17">
                <?php

                if ($model['precoDpsDesconto']==null)
                {
                    echo  $model['produtoPreco'].'€';
                }
                else
                {
                    echo '
                        <span class="block2-oldprice m-text7 p-r-5">
                            '.$model['produtoPreco'].'€
                        </span>
    
                        <span class="block2-newprice m-text8 p-r-5">
                            '.$model['precoDpsDesconto'].'€
                        </span>
                    ';
                }

                ?>
			</span>

            <!--  -->
            <div class="p-t-33 p-b-60">

                <div class="flex-r-m flex-w p-t-10">
                    <div class="w-size16 flex-m flex-w">
                        <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                            <!-- Button -->
                            <a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" href="<?= Url::to(['compra/create', 'id' => $model['idprodutos']])?>">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-b-45">
                <p class="s-text8">Stock: <b><?= $model['produtoStock'] ?> units</b></p>
                <p class="s-text8 m-r-35">Product code: <b><?= $model['produtoCodigo'] ?></b></p>
                <p class="s-text8">
                    Categories:
                    <a href="<?= Url::to(['produto/index', 'categoria' => $produtoCategoria['idcategorias']]) ?>">
                        <?= $produtoCategoria->categoriaNome ?>
                    </a>
                    /
                    <a href="<?= Url::to(['produto/index', 'categoriaChild' => $produtoCategoriaChild['idchild']]) ?>">
                        <?= $produtoCategoriaChild['childNome'] ?>
                    </a>
            </div>
            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4 lol">
                    Description
                    <i id="minuss" class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i id="pluss" class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <?php
                    for ($i=1;$i<=10;$i++)
                    {
                        $description = 'produtoDescricao'.$i;
                        echo '<p class="s-text8">'.$model[$description].'</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>