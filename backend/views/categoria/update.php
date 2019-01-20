<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */

$this->title = 'Update Category: ' . $model->categoriaNome;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$safeCategoriyName = preg_replace('/\s+/', '_', $model->categoriaNome);
$this->params['breadcrumbs'][] = ['label' => $model->categoriaNome, 'url' => ['categoria/index','#'=>$safeCategoriyName]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
