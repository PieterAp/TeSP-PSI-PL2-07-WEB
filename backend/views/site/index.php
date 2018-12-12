<?php

/* @var $this yii\web\View */

use yii\helpers\Url;


?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to backend!</h1>

        <p class="lead">Dear <?= Yii::$app->user->identity->username ?>, get ready to be summoned by the Yii Framework...<small style="font-size: 50%">yay</small></p>
    </div>
    <hr>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-2 col-md-2 col-xs-4 text-center">
                <h2>Categories</h2>
                <p><a style="width: 100%" class="btn btn-default" href="<?= Url::to(['categoria/index']); ?>">Manage</a></p>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-4 text-center">
                <h2>Product</h2>
                <p><a style="width: 100%" class="btn btn-default" href="<?= Url::to(['produto/index']); ?>">View all</a></p>
                <p><a style="width: 100%" class="btn btn-default" href="<?= Url::to(['produto/create']); ?>">Create</a></p>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
