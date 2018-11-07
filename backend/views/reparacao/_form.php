<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reparacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reparacaoNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reparacaoEstado')->dropDownList([ 'Tratamento' => 'Tratamento', 'Aguardar Produto' => 'Aguardar Produto', 'Processamento' => 'Processamento', 'Concluida' => 'Concluida', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reparacaoNumero')->textInput() ?>

    <?= $form->field($model, 'reparacaoData')->textInput() ?>

    <?= $form->field($model, 'reparacaoDataConcluido')->textInput() ?>

    <?= $form->field($model, 'reparacaoDescricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_iduser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
