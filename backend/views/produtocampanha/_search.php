<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CampanhaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campanha-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idCampanha') ?>

    <?= $form->field($model, 'campanhaNome') ?>

    <?= $form->field($model, 'campanhaDataInicio') ?>

    <?= $form->field($model, 'campanhaDescricao') ?>

    <?= $form->field($model, 'campanhaDataFim') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
