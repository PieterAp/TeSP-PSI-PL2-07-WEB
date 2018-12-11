<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-signup">
    <p>Please fill out the following fields to create employee:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($userdata, 'userNomeProprio') ?>
            <?= $form->field($userdata, 'userApelido') ?>

            <label class="control-label">Password</label>
            <?= Html::passwordInput('password','',['class' => 'form-control']) ; ?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
