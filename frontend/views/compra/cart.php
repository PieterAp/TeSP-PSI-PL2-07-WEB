<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-index">
    <h1><?= Html::encode($this->title) ?></h1>
    Historico das compras que ESTAO EM CART compraEstado = 1

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'produto_preco',
            'compraData',
            'produtoNome',
            'produtoMarca',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{purchaseAll}',
                'buttons' => [
                    'purchaseAll' =>  function () {
                        return Html::a('', ['compra/purchase'], ['class' => 'glyphicon glyphicon-shopping-cart']);
                    }
                ]
            ]
        ],
    ]); ?>
    <?php
        if($total){
            echo '<h1> Total: '.$total->compraValor .'€ </h1>';
            echo '<p>';?>
            <?= Html::a('Purchase', ['compra/purchase'], ['class' => 'btn btn-success']);
            echo '</p>';
        }
           
    ?>

</div>