<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */

$this->title = $model->idreparacao;
$this->params['breadcrumbs'][] = ['label' => 'Reparacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reparacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idreparacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idreparacao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idreparacao',
            'reparacaoNome',
            'reparacaoEstado',
            'reparacaoNumero',
            'reparacaoData',
            'reparacaoDataConcluido',
            'reparacaoDescricao',
            'user_iduser',
        ],
    ]) ?>

</div>
