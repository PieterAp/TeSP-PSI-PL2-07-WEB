<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CampanhaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campanhas';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="campanha-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (isset($errors)) {
        echo '<div class="alert alert-danger">
            <strong>Error!</strong> Sales cannot be deleted because sales has products
        </div>';
    } ?>
    <p>
        <?= Html::a('Create Campanha', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'campanhaNome',
            'campanhaDataInicio',
            'campanhaDescricao',
            'campanhaDataFim',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
