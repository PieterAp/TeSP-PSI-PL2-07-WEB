<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->produtoNome;
$this->params['breadcrumbs'][] = ['label' => 'Categorias'];
$this->params['breadcrumbs'][] = ['label' => $produtoCategoria->categoriaNome, 'url' => ['categoria/view', 'id' => $produtoCategoria->idcategorias]];
$this->params['breadcrumbs'][] = ['label' => $produtoCategoriaChild->childNome, 'url' => ['categoria-child/view', 'id' => $produtoCategoriaChild->idchild]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-view">

    <div class="table-bordered">
        <div class="text-center">
            <!-- Carousel starts here -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                        $imagesCount = [];
                        for ($k=1; $k<=4; $k++)
                        {
                            if ($model->{'produtoImagem'.$k} != null)
                            {
                                $imagesCount[] = 'produtoImagem'.$k;
                            }
                        }

                        for ($i=0; $i<count($imagesCount); $i++)
                        {
                            if ($i==0)
                            {
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active" style="background-color: orange"></li>';
                            }
                            else
                            {
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" style="background-color: orange"></li>';
                            }
                        }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    for ($i=0; $i<count($imagesCount); $i++)
                    {
                        $imgPath = Url::to('../images/products/'.$model->idprodutos.'/'.$model->{$imagesCount[$i]});
                        if ($i==0)
                        {
                            echo '<div class="item active" style="backcolor: red;">';

                        }
                        else
                        {
                            echo '<div class="item" style="color: red;">';
                        }
                        echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive text-center', 'style' => 'margin: 0 auto;']);
                        echo '</div>';
                    }

                    ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Carousel ends here -->
        </div>
        <div class="page-header" style="padding-left: 10px;">
            <h1>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?= Html::encode($model->produtoNome) ?><span style="color:#777;"> - <?= $model->produtoMarca ?></span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 text-center">
                        <small>Price:</small>
                        <span style="color:orange;"> <?= $model->produtoPreco ?>€</span>
                    </div>
                </div>
                <small><h4><?= $produtoCategoria->categoriaNome.' / '.$produtoCategoriaChild->childNome ?></h4></small>
            </h1>
        </div>
        <div style="padding-left: 10px;">
            <h3>Description:</h3>
            <div style="padding-left: 20px;">
                <?php
                    for ($i=1;$i<=10;$i++)
                    {
                        $description = 'produtoDescricao'.$i;
                        echo '<p>'.$model->$description.'</p>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
