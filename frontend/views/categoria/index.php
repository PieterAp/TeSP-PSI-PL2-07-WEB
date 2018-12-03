<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if ($categorias==null)
    {
        echo ('<p style="color: red"> There categories available! </p>');
    }
    else
    {
        $i=0;
        echo '
            <div class="body-content">
                <div class="row">';
        foreach ($categorias as $eachCategoria)
        {
            $path = Url::to(['categoria-child/view', 'id' => $eachCategoria['idcategorias']]);

            echo '
                    <div class="col-lg-4 col-md-4 text-left table-bordered">
                        <h4>
                            <div class="page-header">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        '.$eachCategoria['categoriaNome'].'
                                    </div>
                                    <div class="col-lg-6 col-md-6 text-right">
                                        <small>('.$eachCategoria['qntProdutos'].' products)</small>
                                    </div>
                                </div>
                            </div>
                        </h4>
                       
     
                        <p>'.$eachCategoria['categoriaDescricao'].'</p>
        
                        <p class="text-right"><a class="btn btn-success" href="'.$path.'">Take a look &raquo;</a></p>
                    </div>
        
                    ';
            $i++;
        }
        echo '
            </div>
        </div>';
    }
    ?>
</div>
