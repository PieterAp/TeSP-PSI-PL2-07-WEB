<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */

$this->title = 'Update Campanha: ' . $model->idCampanha;
$this->params['breadcrumbs'][] = ['label' => 'Campanhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCampanha, 'url' => ['view', 'id' => $model->idCampanha]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="campanha-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
