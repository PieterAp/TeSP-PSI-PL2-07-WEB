<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = 'Create Categoria Child';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
