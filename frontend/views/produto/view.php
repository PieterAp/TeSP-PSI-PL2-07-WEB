<!DOCTYPE html>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<body class="animsition">
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
                            if ($model->$image!=null)
                            {
                                $imgPath = Url::to('@web/images/products/'.$model['idprodutos'].'/'.$model[$image]);
                                echo '
                                    <div class="item-slick3" data-thumb="'. Url::to($imgPath) .'" style="max-height: 668px; max-width: 501px;">
                                        <div class="wrap-pic-w">
                                            '.Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']).'							        
                                        </div>
                                    </div>   
                                ';
                            }
                        }
                        ?>
                        <div>
                        </div>
                    </div>

			<div class="w-size14 p-t-140 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?= $model->produtoNome ?>
				</h4>

				<span class="m-text17">
					<?= $model->produtoPreco ?>€
				</span>

				<p class="s-text8 p-t-10">
					<?= $produtoCategoria['categoriaNome'] ?> > <?= $produtoCategoriaChild['childNome'] ?>
				</p>

				<!--  -->
				<div class="p-t-20 p-b-60">
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
                                <a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachProduct['idprodutos']]).'">
                                    Add to Cart
                                </a>
                            </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php if($model->produtoDescricao1 != null or $model->produtoDescricao2 != null or $model->produtoDescricao3 != null or $model->produtoDescricao4 != null or $model->produtoDescricao5 != null or $model->produtoDescricao6 != null or $model->produtoDescricao7 != null or $model->produtoDescricao8 != null or $model->produtoDescricao9 != null or $model->produtoDescricao10 != null){ ?>
	<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content m-t-20" style="max-width: 1000px;
    margin-left: 25%;    margin-right: 25%;">
		<h5 class="flex-sb-m cs-pointer m-text19 color0-hov trans-0-4 dropdown1">
			Description
			<i class="up-mark fs-12 color1 fa fa-plus plus1" aria-hidden="true"></i>
		</h5>

		<div class="dropdown-content dis-none p-t-15 p-b-23 down1">
                <?php
                for ($i=1;$i<=10;$i++)
                {
                    $description = 'produtoDescricao'.$i;
                    echo '<p class="s-text8">'.$model->$description.'</p>';
                }
                ?>
		</div>
	</div>
<?php } ?>
        </div>
