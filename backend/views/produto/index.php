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
    <?php // echo $this->render('_search', ['model' => $searchModel]);
        if (isset($error)){
            echo '<div class="alert alert-danger">
            <strong>Error! </strong>'.$error.'
            </div>';
        }
    ?>
    
    <p>
        <?= Html::a('Create Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'produtoNome',
            'produtoCodigo',
            'produtoDataCriacao',
            'produtoStock',
            //'produtoPreco',
            'produtoMarca',
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
            //'categoria_child_id',
            //'produtoImagem1',
            //'produtoImagem2',
            //'produtoImagem3',
            //'produtoImagem4',

            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} {hideshow} {edit} {remove}',  // the default buttons + your custom button
                'buttons' => [
                    'add' =>  function ($key, $model) {
                        return Html::a('', ['produto/produtocampanha', 'id' => $model->idprodutos], ['class' => 'glyphicon glyphicon-plus']);
                    },
                    'hideshow' => function ($key, $model)
                    {
                        if ($model->produtoEstado == 0)
                        {
                            return Html::a('', ['produto/changeestado', 'id' => $model->idprodutos], ['class' => 'glyphicon glyphicon-eye-open']);

                        }
                        elseif ($model->produtoEstado == 1)
                        {
                            return Html::a('', ['produto/changeestado', 'id' => $model->idprodutos], ['class' => 'glyphicon glyphicon-eye-close']);

                        }
                    },
                    'edit' =>  function ($key, $model) {
                        return Html::a('', ['produto/update', 'id' => $model->idprodutos], ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'remove' =>  function ($key, $model) {
                        if (\Yii::$app->user->can('deleteProduto'))
                        {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',['produto/delete', 'id' => $model->idprodutos],['data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ]]);
                        }
                    }

                ]
            ],
            [
                'header' => 'Stock',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} {remove}',  // the default buttons + your custom button
                'buttons' => [
                    'add' => function ($key, $model)
                    {
                        return Html::a('', ['produto/stock', 'id' => $model->idprodutos, 'action' => 'add'], ['class' => 'glyphicon glyphicon-arrow-up']);
                    },
                    'remove' => function ($key, $model)
                    {
                        if ($model->produtoStock > 0)
                        {
                            return Html::a('', ['produto/stock', 'id' => $model->idprodutos, 'action' => 'remove'], ['class' => 'glyphicon glyphicon-arrow-down']);

                        }
                    },
                ]
            ]
        ],
    ]); ?>
</div>
