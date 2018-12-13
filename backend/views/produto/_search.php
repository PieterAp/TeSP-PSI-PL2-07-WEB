<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idprodutos') ?>

    <?= $form->field($model, 'produtoNome') ?>

    <?= $form->field($model, 'produtoCodigo') ?>

    <?= $form->field($model, 'produtoDataCriacao') ?>

    <?= $form->field($model, 'produtoStock') ?>

    <?php // echo $form->field($model, 'produtoPreco') ?>

    <?php // echo $form->field($model, 'produtoMarca') ?>

    <?php // echo $form->field($model, 'produtoDescricao1') ?>

    <?php // echo $form->field($model, 'produtoDescricao2') ?>

    <?php // echo $form->field($model, 'produtoDescricao3') ?>

    <?php // echo $form->field($model, 'produtoDescricao4') ?>

    <?php // echo $form->field($model, 'produtoDescricao5') ?>

    <?php // echo $form->field($model, 'produtoDescricao6') ?>

    <?php // echo $form->field($model, 'produtoDescricao7') ?>

    <?php // echo $form->field($model, 'produtoDescricao8') ?>

    <?php // echo $form->field($model, 'produtoDescricao9') ?>

    <?php // echo $form->field($model, 'produtoDescricao10') ?>

    <?php // echo $form->field($model, 'categoria_child_id') ?>

    <?php // echo $form->field($model, 'produtoImagem1') ?>

    <?php // echo $form->field($model, 'produtoImagem2') ?>

    <?php // echo $form->field($model, 'produtoImagem3') ?>

    <?php // echo $form->field($model, 'produtoImagem4') ?>

    <?php // echo $form->field($model, 'produtoEstado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
