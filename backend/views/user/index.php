<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Users';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            ['label' => 'First name', 'value' => 'userNomeProprio'],
            ['label' => 'Last name', 'value' => 'userApelido'],
            ['label' => 'Hide/seek', 'value' => 'userVisibilidade'],
            [
                'label' => 'Role',
                'value' => function ($dataProvider) {
                    $roles = \Yii::$app->authManager->getRolesByUser($dataProvider['id']);
                    $role = '';
                    foreach($roles as $key => $value)
                    {
                        $role = $key;
                    }
                    return $role;
                },
            ],
            /*[
                'attribute' => 'Action',
                'format' => 'raw',
                'header' => 'Action',

                'value' =>
                    function ($dataProvider) {
                        return Html::a('', ['delete', 'id' =>'1'], [
                                    'class' => 'glyphicon glyphicon-remove',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                        ]);
                    },
                'ad'


                /*'value' =>
                    function ($dataProvider) {
                    $url = Url::to(['view', 'id' => $dataProvider['id']]);
                        $urldelete = Url::to(['delete', 'id' => $dataProvider['id']]);

                    return '<a href='.$url.'><span class="glyphicon glyphicon-eye-open"></span></a> <a href='.$urldelete.'><span class="glyphicon glyphicon-remove"></span></a>';

                },


            ],
            Html::a('Edit', ['update', 'id' => $dataProvider->id], ['class' => 'btn btn-primary']),
            Html::a('Delete', ['delete', 'id' =>$dataProvider->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]),
            Html::a('Back','index', ['class' => 'btn btn-warning']),*/
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',  // the default buttons + your custom button

            ]
        ]
    ]); ?>
</div>
