<?php

use common\models\Compra;
use common\models\Produto;
use common\models\User;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reparacao-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reparacaoNome')->dropDownList(
        ArrayHelper::map(Produto::find()->all(),'produtoNome',
            function($model)
            {
                return $model['produtoNome'];
            }
        ),
        ['prompt'=>'Select product'])->label('Product:') ?>


    <?= $form->field($model, 'reparacaoEstado')->dropDownList([ 'Tratamento' => 'Tratamento', 'Aguardar Produto' => 'Aguardar Produto', 'Processamento' => 'Processamento', 'Concluida' => 'Concluida', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reparacaoNumero')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'reparacaoData')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'reparacaoDataConcluido')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
    ])->textInput()?>

    <?= $form->field($model, 'reparacaoDescricao')->textInput(['maxlength' => true])->textarea(['rows' => '6']) ?>


    <?= $form->field($model, 'user_iduser')->dropDownList(
        ArrayHelper::map(User::find()
                        ->innerJoin('userdata', 'user.id = userdata.iduser')
                        ->where(['userVisibilidade'=>1])
                        ->all(),'id',
            function($model)
            {
                return $model['id'].' - '.$model['username'].' - '.$model['email'];
            }
        ),
        ['prompt'=>''])->label('User:') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
