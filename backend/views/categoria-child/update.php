<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = 'Update sub-category: ' . $model->childNome;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Children', 'url' => ['index']];
$safeSubCategoriyName = preg_replace('/\s+/', '_', $model->childNome);
$this->params['breadcrumbs'][] = ['label' => $model->childNome, 'url' => ['categoria/index','#'=>$safeSubCategoriyName]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-child-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
