<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReparacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reparacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reparacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reparacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idreparacao',
            'reparacaoNome',
            'reparacaoEstado',
            'reparacaoNumero',
            'reparacaoData',
            //'reparacaoDataConcluido',
            //'reparacaoDescricao',
            //'user_iduser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
