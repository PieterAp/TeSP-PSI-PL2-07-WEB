<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */

$this->title = $model->categoriaNome;
$this->params['breadcrumbs'][] = ['label' => 'Categorias'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div style="text-align: center">
        <?php
        echo ('<h3>Sub Categorias:</h3>');
        if ($allCategoriaChilds==null)
        {
            echo ('<p style="color: red"> There are no sub categories inside this caregory! </p>');
        }
        else
        {
            echo '                
                <div class="body-content">
                    <div class="row">';
            foreach ($allCategoriaChilds as $eachCategoriaChilds)
            {
                //$path = Url::to(['categoria-child/view', ['id' => $eachCategoriaChilds->idchild, 'categoriaSelecionada' => $eachCategoriaChilds]]);
                $path = Url::to(['categoria-child/view', 'id' => $eachCategoriaChilds->idchild]);


                echo '
                            <div class="col-lg-4 col-md-4 text-left table-bordered">
                                <h4>'.$eachCategoriaChilds->childNome.'</h4>
    
                                <p>'.$eachCategoriaChilds->childDescricao.'</p>   
                                
                                <p class="text-right"><a class="btn btn-success" href="'.$path.'">Take a look &raquo;</a></p>                        
                            </div>

                ';
                //Simple way of doing things
                //$path = Url::to(['categoria-child/view', 'id' => $eachCategoriaChilds->idchild]);
                //echo('<a class="btn btn-default" href="'.$path.'">'.$eachCategoriaChilds->childNome.'</a>');
            }
            echo '
                    </div>
                </div>';
        }




        echo '<br><br>';
        echo ('<h3>Produtos:</h3>');
        if ($allProducts==null)
        {
            echo ('<p style="color: red"> There are no products inside this caregory! </p>');
        }
        else
        {
            echo '                
                <div class="body-content">
                    <div class="row">';
            foreach ($allProducts as $eachProduct)
            {
                $path = Url::to(['produto/view', 'id' => $eachProduct->idprodutos]);

                echo '
                            <div class="col-lg-4 col-md-4 text-left table-bordered">
                                <h4>'.$eachProduct->produtoNome.'</h4>
           
                                <p>'.$eachProduct->produtoDescricao1.'</p>
                                <p>'.$eachProduct->produtoDescricao2.'</p>
                                <p>'.$eachProduct->produtoDescricao3.'</p>
                                
                                <p class="text-right"><a class="btn btn-success" href="'.$path.'">Take a look &raquo;</a></p>                        
                            </div>

                ';
                //Simple way of doing things
                //$path = Url::to(['categoria-child/view', 'id' => $eachCategoriaChilds->idchild]);
                //echo('<a class="btn btn-default" href="'.$path.'">'.$eachCategoriaChilds->childNome.'</a>');
            }
            echo '
                    </div>
                </div>';
        }

        ?>
    </div>
</div>
