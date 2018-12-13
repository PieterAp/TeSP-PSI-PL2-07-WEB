<?php

use common\models\CategoriaChild;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'produtoNome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'produtoMarca')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'produtoCodigo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'categoria_child_id')->dropDownList(
                ArrayHelper::map(CategoriaChild::find()->all(),'idchild','childNome'),
                ['promt'=>'Select Sub-category'])->label('Belonging to Sub-category:') ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'produtoStock')->textInput() ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'produtoPreco')->textInput() ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao2')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao3')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao4')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao5')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao6')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao7')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao8')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao9')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'produtoDescricao10')->textInput(['maxlength' => true]) ?>
        </div>
    </div>




    <div class="row">
        <div class="col-lg-3 col-md-3">
            <?php
                echo $form->field($model, 'produtoImagem1')->fileInput()->label('Image 1 & cover image');
                if ($model->produtoImagem1!=null)
                {
                    $imgPath = Url::to('../../../frontend/web/images/products/'.$model->idprodutos.'/'.$model->produtoImagem1);
                    echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                }
            ?>
        </div>
        <div class="col-lg-3 col-md-3">
            <?php
                echo $form->field($model, 'produtoImagem2')->fileInput();
                if ($model->produtoImagem2!=null)
                {
                    $imgPath = Url::to('../../../frontend/web/images/products/' . $model->idprodutos . '/' . $model->produtoImagem2);
                    echo Html::img($imgPath, ['alt' => 'some', 'class' => 'img-responsive']);
                }
            ?>
        </div>
        <div class="col-lg-3 col-md-3">
            <?php
                echo $form->field($model, 'produtoImagem3')->fileInput();
                if ($model->produtoImagem3!=null)
                {
                    $imgPath = Url::to('../../../frontend/web/images/products/' . $model->idprodutos . '/' . $model->produtoImagem3);
                    echo Html::img($imgPath, ['alt' => 'some', 'class' => 'img-responsive']);
                }
            ?>
        </div>
        <div class="col-lg-3 col-md-3">
            <?php
                echo $form->field($model, 'produtoImagem4')->fileInput();
                if ($model->produtoImagem4!=null)
                {
                    $imgPath = Url::to('../../../frontend/web/images/products/' . $model->idprodutos . '/' . $model->produtoImagem4);
                    echo Html::img($imgPath, ['alt' => 'some', 'class' => 'img-responsive']);
                }
            ?>
        </div>
    </div>



    <div class="form-group" style="padding-top: 20px">
        <div style="float: left;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        </div>
        <div style="float: left;">
            <?php
            if (($model->produtoEstado == 1) or (!isset($model->produtoEstado)))
            {
                $model->produtoEstado = true;
            }
            else
            {
                $model->produtoEstado = false;
            }
            ?>
            <?= $form->field($model, 'produtoEstado')->checkbox(array(
                'label'=>'Product visibility',
                'labelOptions'=>array('style'=>'padding:5px;'),
            ))
                ->label(''); ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
