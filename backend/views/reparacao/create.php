<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Reparacao */

$this->title = 'Create Reparacao';
$this->params['breadcrumbs'][] = ['label' => 'Reparacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reparacao-create">

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'produtos' => $produtos,
    ]) ?>

</div>
