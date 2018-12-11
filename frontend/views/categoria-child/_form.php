<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-child-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'childNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'childDescricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_idcategorias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
