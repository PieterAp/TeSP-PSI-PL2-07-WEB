<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */


?>
<div class="campanha-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'productsale' => $productsale,
        'sales' => $sales,
        'products' => $products,
        'listsales' =>$listsales,
        'listproducts' => $listproducts,
    ]) ?>

</div>
