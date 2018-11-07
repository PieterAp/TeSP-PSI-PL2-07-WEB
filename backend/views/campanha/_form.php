<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campanha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'campanhaNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campanhaDataInicio')->textInput() ?>

    <?= $form->field($model, 'campanhaDescricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campanhaDataFim')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
