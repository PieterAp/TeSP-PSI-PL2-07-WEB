<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */

$this->title = 'Update Reparacao: ' . $model->idreparacao;
$this->params['breadcrumbs'][] = ['label' => 'Reparacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idreparacao, 'url' => ['view', 'id' => $model->idreparacao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reparacao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
