<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campanha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($productsale, 'campanhaPercentagem')->textInput(['maxlength' => true]);?>
    <?php echo $form->field($listsales[0], 'idCampanha')
            ->dropDownList(
                ArrayHelper::map($listsales, 'idCampanha', 'campanhaNome'),
                ['options'=>[$sales[0]['idCampanha']=>["Selected"=>true]]]
            );
    ?>

    <?php echo $form->field($listproducts[0], 'idprodutos')
        ->dropDownList(
            ArrayHelper::map($listproducts, 'idprodutos', 'produtoNome'),
            ['options'=>[$products[0]['idprodutos']=>["Selected"=>true]]]
        );
    ?>

    
   



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
