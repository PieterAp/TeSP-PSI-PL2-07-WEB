<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = 'Create Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">

    <?= $this->render('_formProdutocampanha', [
        'productsale' => $productsale,
        'sale' => $sale,
        'sales' => $sales,
    ]) ?>

</div>

