<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="row">
    <div class="col-lg-5">
       <?=  Yii::$app->user->id;?>
       <?=  Yii::$app->user->identity->username;?>
       <?=  Yii::$app->user->identity->email;?>
    </div>
</div>
