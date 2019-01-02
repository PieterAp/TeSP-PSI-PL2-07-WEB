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

    <?= $form->field($model, 'childNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'childDescricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_idcategorias')->dropDownList(
        ArrayHelper::map(Categoria::find()->all(),'idcategorias','categoriaNome'),
        ['promt'=>'Select category'])->label('Belonging to category:') ?>

    <div class="form-group" style="padding-top: 20px">
        <div style="float: left;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div style="float: left;">
            <?= $form->field($model, 'childEstado')->checkbox(array(
                'label'=>'Category visibility',
                'labelOptions'=>array('style'=>'padding:5px;'),
            ))
                ->label(''); ?>
        </div>
    </div>






    <?php ActiveForm::end(); ?>

</div>
