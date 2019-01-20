<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $userdata,
        'attributes' => [
            'iduser',
            'user_id',
            'userNomeProprio',
            'userApelido',
            'userDataNasc',
            'userEstado',
            'userMorada',
            'userVisibilidade',
        ]
    ]) ?>

</div>
