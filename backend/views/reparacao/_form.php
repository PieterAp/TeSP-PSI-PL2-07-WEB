<?php

use common\models\Compra;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reparacao-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <h1><?= $model->reparacaoNumero ?></h1>
        </div>
        <div class="col-md-6">
            <h1><?= $model->reparacaoData ?></h1>
        </div>
    </div>


    <?= $form->field($model, 'reparacaoNome')->dropDownList(
        ArrayHelper::map(Compra::find()
            ->rightJoin('compraproduto', 'compraproduto.compra_idcompras = compra.idcompras')
            ->leftJoin('produto', 'compraproduto.produto_idprodutos = produto.idprodutos')
            ->where(['produtoEstado'=>1])
            ->andWhere(['compra.compraEstado' => 0])
            ->groupBy('produto_idprodutos')
            ->orderBy('compraData DESC')
            ->all(),'idcompras',
            function($model)
            {
                return $model['idcompras'];
            }
        ),
        ['prompt'=>'Select product'])->label('Product:') ?>


    <?= $form->field($model, 'reparacaoEstado')->dropDownList([ 'Tratamento' => 'Tratamento', 'Aguardar Produto' => 'Aguardar Produto', 'Processamento' => 'Processamento', 'Concluida' => 'Concluida', ], ['prompt' => '']) ?>

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
