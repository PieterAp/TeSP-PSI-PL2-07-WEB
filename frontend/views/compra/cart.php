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
            'produtoStock',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',

            ]
        ],
    ]); ?>
    <?php
    $ok = sizeof($dataProvider->models);

    for ($i=0;$i<$ok;$i++){
        if ($dataProvider->models[$i]['produtoStock']>0){
            $va = 1;
        }
    }
    if(isset ($total) && isset ($va)){
            echo '<h1> Total: '.$total->compraValor .'€ </h1>';
            echo '<p>';?>
            <?= Html::a('Purchase', ['compra/purchase'], ['class' => 'btn btn-success']);
            echo '</p>';
    }
    ?>
</div>