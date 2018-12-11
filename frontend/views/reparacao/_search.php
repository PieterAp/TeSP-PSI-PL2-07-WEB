<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReparacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reparacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idreparacao') ?>

    <?= $form->field($model, 'reparacaoNome') ?>

    <?= $form->field($model, 'reparacaoEstado') ?>

    <?= $form->field($model, 'reparacaoNumero') ?>

    <?= $form->field($model, 'reparacaoData') ?>

    <?php // echo $form->field($model, 'reparacaoDataConcluido') ?>

    <?php // echo $form->field($model, 'reparacaoDescricao') ?>

    <?php // echo $form->field($model, 'user_iduser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
