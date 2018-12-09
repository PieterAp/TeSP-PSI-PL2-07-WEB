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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
