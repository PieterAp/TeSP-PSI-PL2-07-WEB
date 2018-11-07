<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */

$this->title = 'Create Reparacao';
$this->params['breadcrumbs'][] = ['label' => 'Reparacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reparacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
