<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Campanha */

$this->title = 'Create Campanha';
$this->params['breadcrumbs'][] = ['label' => 'Campanhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campanha-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
