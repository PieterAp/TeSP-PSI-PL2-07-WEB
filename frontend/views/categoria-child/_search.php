<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaChildSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-child-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idchild') ?>

    <?= $form->field($model, 'childNome') ?>

    <?= $form->field($model, 'childDescricao') ?>

    <?= $form->field($model, 'categoria_idcategorias') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
