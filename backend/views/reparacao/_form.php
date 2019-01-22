<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reparacao-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reparacaoNome')->dropDownList(
        $produtos,
        ['promt'=>'Select product'])->label('Product:') ?>

    <?= $form->field($model, 'reparacaoEstado')->dropDownList([ 'Tratamento' => 'Tratamento', 'Aguardar Produto' => 'Aguardar Produto', 'Processamento' => 'Processamento', 'Concluida' => 'Concluida', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reparacaoData')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd ',
    ])->textInput()?>

    <?= $form->field($model, 'reparacaoDataConcluido')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
    ])->textInput()?>

    <?= $form->field($model, 'reparacaoDescricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_iduser')->dropDownList(
        $users->id,
        ['promt'=>'Select user'])->label('User:') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
