<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Categoria;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-child-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if (isset($categoriaAssociada))
    {
        $model->categoria_idcategorias = $categoriaAssociada->idcategorias;
    }
    ?>

    <?= $form->field($model, 'childNome')->textInput(['maxlength' => true])->label('Name') ?>

    <?= $form->field($model, 'childDescricao')->textInput(['maxlength' => true])->label('Description') ?>

    <!-- $form->field($model, 'categoria_idcategorias')->textInput() -->

    <?= $form->field($model, 'categoria_idcategorias')->dropDownList(
        ArrayHelper::map(Categoria::find()->all(),'idcategorias','categoriaNome'),
        ['promt'=>'Select category'])->label('Belonging to category:') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
