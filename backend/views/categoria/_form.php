<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(['id' => 'form-category']); ?>

    <?= $form->field($model, 'categoriaNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoriaDescricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group" style="padding-top: 20px">
        <div style="float: left;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div style="float: left;">
            <?= $form->field($model, 'categoriaEstado')->checkbox(array(
                'label'=>'Category visibility',
                'labelOptions'=>array('style'=>'padding:5px;'),
            ))
                ->label(''); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
