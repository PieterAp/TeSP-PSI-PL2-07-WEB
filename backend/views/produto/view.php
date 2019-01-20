<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->produtoNome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idprodutos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idprodutos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idprodutos',
            'produtoNome',
            'produtoCodigo',
            'produtoDataCriacao',
            'produtoStock',
            'produtoPreco',
            'produtoMarca',
            'produtoDescricao1',
            'produtoDescricao2',
            'produtoDescricao3',
            'produtoDescricao4',
            'produtoDescricao5',
            'produtoDescricao6',
            'produtoDescricao7',
            'produtoDescricao8',
            'produtoDescricao9',
            'produtoDescricao10',
            'categoria_child_id',
            'produtoImagem1',
            'produtoImagem2',
            'produtoImagem3',
            'produtoImagem4',
        ],
    ]) ?>

</div>
