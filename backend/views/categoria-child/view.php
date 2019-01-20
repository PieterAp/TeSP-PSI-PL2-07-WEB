<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = $model->idchild;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-child-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idchild], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idchild], [
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
            'idchild',
            'childNome',
            'childDescricao',
            'categoria_idcategorias',
        ],
    ]) ?>

</div>
