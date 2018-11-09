<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
DatePicker::widget([
    'model' => 'datePicker',
    'attribute' => 'from_date',
    'language' => 'en',
    'dateFormat' => 'php:Y-m-d',
]);
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['readonly'=> true]) ?>
    <?= $form->field($userdata, 'userNomeProprio')->textInput() ?>
    <?= $form->field($userdata, 'userApelido')->textInput() ?>
    <?= $form->field($userdata, 'userNIF')->textInput() ?>
    <?= $form->field($userdata, 'userDataNasc')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
    ])?>
    <?= Html::passwordInput('password','',['class' => 'form-control']) ; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
