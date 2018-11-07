<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produtoNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoCodigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDataCriacao')->textInput() ?>

    <?= $form->field($model, 'produtoStock')->textInput() ?>

    <?= $form->field($model, 'produtoPreco')->textInput() ?>

    <?= $form->field($model, 'produtoMarca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoDescricao10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_idcategorias')->textInput() ?>

    <?= $form->field($model, 'produtoImagem1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoImagem2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoImagem3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produtoImagem4')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
