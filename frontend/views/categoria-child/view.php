<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = $model->childNome;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-child-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div style="text-align: center">
        <?php
        echo ('<h3>Produtos:</h3>');
        if ($allProducts==null)
        {
            echo ('<p style="color: red"> There are no products inside this caregory! </p>');
        }
        else
        {
            echo'
                <div class="body-content">
                    <div class="row">';
            foreach ($allProducts as $eachProduct)
            {
                $path = Url::to(['produto/view', 'id' => $eachProduct->idprodutos]);

                echo '
                        <div class="col-lg-4 text-left table-bordered">
                            <h2>'.$eachProduct->produtoNome.'</h2>

                            <p>Descrição do produto:</p>            
                            <p>'.$eachProduct->produtoDescricao1.'</p>
                            <p>'.$eachProduct->produtoDescricao2.'</p>
                            <p>'.$eachProduct->produtoDescricao3.'</p>
                            <p>'.$eachProduct->produtoDescricao4.'</p>
                            <p>'.$eachProduct->produtoDescricao5.'</p>
                            <p>(...)</p>
                            
            
                            <p class="text-right"><a class="btn btn-warning" href="'.$path.'">Take a look &raquo;</a></p>
                        </div>
                ';


                //Simple way of doing things
                //$path = Url::to(['produto/view', 'id' => $eachProduct->idprodutos]);
                //echo('<a class="btn btn-default" href="'.$path.'">'.$eachProduct->produtoNome.'</a>');
            }
            echo'</div>
                   </div>';
        }

        ?>
    </div>
</div>
