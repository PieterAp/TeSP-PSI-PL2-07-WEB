<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create User';
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'userdata' => $userdata,
    ]) ?>

</div>
