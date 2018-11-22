<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idprodutos',
            'produtoNome',
            'produtoCodigo',
            'produtoDataCriacao',
            'produtoStock',
            //'produtoPreco',
            //'produtoMarca',
            //'produtoDescricao1',
            //'produtoDescricao2',
            //'produtoDescricao3',
            //'produtoDescricao4',
            //'produtoDescricao5',
            //'produtoDescricao6',
            //'produtoDescricao7',
            //'produtoDescricao8',
            //'produtoDescricao9',
            //'produtoDescricao10',
            //'categoria_idcategorias',
            //'produtoImagem1',
            //'produtoImagem2',
            //'produtoImagem3',
            //'produtoImagem4',

            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {add} {delete}',  // the default buttons + your custom button
                'buttons' => [
                    'add' =>  function ($key, $model) {
                        return Html::a('', ['compra/create', 'id' => $model->idprodutos], ['class' => 'glyphicon glyphicon-plus']);
                    }
                ]
            ]
        ],
    ]); ?>
</div>
