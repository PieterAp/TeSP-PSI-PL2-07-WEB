<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Campanha */

$this->title = $model->idCampanha;
$this->params['breadcrumbs'][] = ['label' => 'Campanhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campanha-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idCampanha], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCampanha], [
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
            'idCampanha',
            'campanhaNome',
            'campanhaDataInicio',
            'campanhaDescricao',
            'campanhaDataFim',
        ],
    ]) ?>

</div>
