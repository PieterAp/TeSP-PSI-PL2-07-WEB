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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['header' => 'Product name', 'attribute' => 'produtoNome'],
            ['header' => 'Product Price', 'attribute' => 'produto_preco'],
            ['header' => 'Date', 'attribute' => 'compraData'],
            ['header' => 'Brand', 'attribute' => 'produtoMarca'],
        ],
    ]); ?>
</div>