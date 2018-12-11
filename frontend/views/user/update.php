<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $model common\models\Userdata */


$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modal-dialog">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,

    ]) ?>


</div>
