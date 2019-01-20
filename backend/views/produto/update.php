<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = 'Update Product: ' . $model->produtoNome;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->produtoNome, 'url' => ['view', 'id' => $model->idprodutos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
