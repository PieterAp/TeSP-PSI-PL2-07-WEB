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
    <?php if (isset($errors)) {
        echo '<div class="alert alert-danger">
            <strong>Error!</strong> Something went wrong
        </div>';
    } ?>


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
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}{delete}',  // the default buttons + your custom button
                'buttons' => [
                    'add' =>  function ($key,$dataProvider) {
                        return Html::a('', ['produtocampanha/update', 'idprodutocampanha' => $dataProvider['idprodutocampanha']], ['class' => 'glyphicon glyphicon-edit']);
                    } ,
                    'delete' =>  function ($key,$dataProvider) {
                        if (\Yii::$app->user->can('deleteCampanha')) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span><br>',['produtocampanha/delete', 'id' => $dataProvider['idprodutocampanha']],['data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ]]);
                        }
                    }
                ]
            ]
        ],
    ]); ?>
</div>
