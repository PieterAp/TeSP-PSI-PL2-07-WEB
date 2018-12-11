<?php
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


DatePicker::widget([
    'model' => 'datePicker',
    'attribute' => 'from_date',
    'language' => 'en',
    'dateFormat' => 'php:Y-m-d',
]);

$this->title = 'Sign up';
?>
<h1 style="text-align:center"><?= Html::encode($this->title) ?></h1>
<div class="modal-dialog">
    <div class="loginmodal-container">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'userNomeProprio')->textInput()->label('First name')  ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'userApelido')->textInput()->label('Last name')  ?>
            </div>
        </div>

        <?= $form->field($model, 'userNIF')->textInput()->label('NIF')  ?>
        <?= $form->field($model, 'userMorada')->textInput()->label('Adress')  ?>
        <?= $form->field($model, 'userDataNasc')->widget(\yii\jui\DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
        ])->textInput()->label('Birthday') ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

