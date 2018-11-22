<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = 'Update Categoria Child: ' . $model->idchild;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idchild, 'url' => ['view', 'id' => $model->idchild]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
