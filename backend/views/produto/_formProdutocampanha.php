<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="produto-form">
    <?php if (isset($sales[0])){
     $form = ActiveForm::begin(); ?>
    <?= $form->field($productsale, 'campanhaPercentagem')->textInput(['maxlength' => 2]) ?>
    <?php echo $form->field($sales[0], 'campanhaNome')
    ->dropDownList
    ($sale, ['prompt'=>'Choose...']);
    }else{
    echo '<div class="alert alert-danger">Sales not found</div>';

    } ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
