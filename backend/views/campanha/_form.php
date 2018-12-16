<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campanha-form">

    <?php $form = ActiveForm::begin(['id' => 'form-sales']); ?>

    <?= $form->field($model, 'campanhaNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campanhaDataInicio')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
    ])->textInput()?>

    <?= $form->field($model, 'campanhaDataFim')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
    ])->textInput()?>
    <?= $form->field($model, 'campanhaDescricao')->textInput(['maxlength' => true]) ?>
    
   



    <?php
   /* if (isset($product[0])){
        echo $form->field($product[0], 'produtoNome')
            ->dropDownList
            ($produtos, ['prompt'=>'Choose...']);
    }else{
        //Yii::$app->response->redirect(['produto/index']);
        var_dump('NO PRODUCTS FOUND!');
        DIE();

    }*/
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
