<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($productsale, 'campanhaPercentagem')->textInput(['maxlength' => 2]) ?>


    <?php if (isset($sales[0])){
    echo $form->field($sales[0], 'campanhaNome')
    ->dropDownList
    ($sale, ['prompt'=>'Choose...']);
    }else{
    Yii::$app->response->redirect(['produto/index']);
    var_dump('SALES NOT FOUND!');
    DIE();

    } ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
