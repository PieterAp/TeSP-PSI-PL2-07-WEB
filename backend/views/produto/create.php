<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
