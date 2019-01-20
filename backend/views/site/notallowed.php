<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="login-box">
    <div class="login-logo">
        <span class="logo-lg">
            <b style="display: inline-flex;">
                <span style="color: #F44336;">
                    Fix
                </span>
                <span style="color: #37a0f4;">
                    Byte
                </span>
            </b>
            <span style="color: white;">Backend</span>
        </span>
    </div>
</div>

<div class="site-error" style="padding: 20px; border-top: 0; color: white; text-align: center">
    <h1>You are not allowed to access this section</h1>
    <h4>Please contact us if you think this is a server error. Thank you.</h4>
    <div style="padding-top: 20px;">
        <h4>Click <a href="<?= Url::to(['site/frontend'])?>">here</a> to go back to a <b>safe</b> place!</h4>
    </div>
</div>