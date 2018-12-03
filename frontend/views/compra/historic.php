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
    Historico das compras que foram compradas compraEstado = 0
    <p>
        <?= Html::a('Create Compra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'produto_preco',
            'compraData',
            'produtoNome',
            'produtoMarca',
        ],
    ]); ?>
</div>