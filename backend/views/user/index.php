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
            [
                'label' => 'Hide/Show',
                'value' => function ($dataProvider) {
                    if ($dataProvider['userVisibilidade']==1){
                        return 'Visible';
                    }else{
                        return 'Hidden';
                    }
                },
            ],
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
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {edit} {remove}',  // the default buttons + your custom button
                'buttons' => [
                    'view' =>  function ($key, $model) {

                        return Html::a('', ['user/update', 'id' => $model['id']], ['class' => 'glyphicon glyphicon-eye-open']);
                    },
                    'edit' =>  function ($key, $model) {

                        return Html::a('', ['user/update', 'id' => $model['id']], ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'remove' =>  function ($key, $model) {
                        if (\Yii::$app->user->can('deleteCliente'))
                        {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',['user/delete', 'id' => $model['id']],['data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ]]);
                        }
                    }

                ]
            ],
        ]
    ]); ?>
</div>
