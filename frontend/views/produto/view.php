<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->produtoNome;
$this->params['breadcrumbs'][] = ['label' => 'Categorias'];
$this->params['breadcrumbs'][] = ['label' => $produtoCategoria->categoriaNome, 'url' => ['categoria/view', 'id' => $produtoCategoria->idcategorias]];
$this->params['breadcrumbs'][] = ['label' => $produtoCategoriaChild->childNome, 'url' => ['categoria-child/view', 'id' => $produtoCategoriaChild->idchild]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-view">

    <div class="table-bordered">

        <?= Html::img('@web/images/face.jpg', ['alt'=>'face', 'class'=>'img-responsive text-center', 'style' => 'width:100%;']);?>
        <div class="page-header" style="padding-left: 10px;">
            <h1><?= Html::encode($model->produtoNome) ?><span style="color:#777;"> - <?= $model->produtoMarca ?></span>
                <br>
                <small><h4><?= $produtoCategoria->categoriaNome.'/'.$produtoCategoriaChild->childNome ?></h4></small>
            </h1>
        </div>
        <div style="padding-left: 10px;">
            <h3>Description:</h3>
            <div style="padding-left: 20px;">
                <?php
                    for ($i=1;$i<=10;$i++)
                    {
                        $description = 'produtoDescricao'.$i;
                        echo '<p>'.$model->$description.'</p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <br>

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
