<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CampanhaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produtos da campanha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campanha-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'produtoNome',
            'campanhaPercentagem',
            'campanhaNome',
            'campanhaDataInicio',
            'campanhaDescricao',
            'campanhaDataFim',
        ],
    ]); ?>
</div>
