<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
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

<div class="error-page" style="margin-top: 100px; color: white">
    <?php
        if ($exception->statusCode==404)
        {
            echo  '<h2 class="headline text-yellow" style="margin: 0px;">';
        }
        else
        {
            echo  '<h2 class="headline text-red" style="margin: 0px;">';
        }
    ?>

     <?= $exception->statusCode ?> </h2>

    <div class="error-content" style=" display: flow-root; vertical-align: middle;">
        <h3 style="font-family: 'Montserrat', sans-serif; font-size: 25px;">
            <?php
            if ($exception->statusCode==404)
            {
                echo  '<i class="fa fa-warning text-yellow"></i> Oops! Page not found.';
            }
            else if ($exception->statusCode==500)
            {
                echo  '<i class="fa fa-warning text-red"></i> Oops! Something went wrong.';
            }
            else
            {
                echo  '<i class="fa fa-warning text-red"></i> '.Html::encode($this->title);
            }
            ?>
        </h3>

        <h4 style="font-family: 'Montserrat', sans-serif;">
            <?php
            if ($exception->statusCode==404)
            {
                echo  'We could not find the page you were looking for.';
            }
            else if ($exception->statusCode==500)
            {
                echo  'We will work on fixing that right away. Meanwhile, you may return to dashboard or try using the search form.';
            }
            else
            {
                echo  nl2br(Html::encode($message));
            }
            ?>
        </h4>
    </div>
    <br>
    <div style="position: absolute; left: 50%; margin-top: 35px;">
        <div style="position: relative; left: -50%;">
            <h4 style="font-family: 'Montserrat', sans-serif;">
                The above error occurred while the Web server was processing your request.
                <br>
                Please contact us if you think this is a server error.<br><br> Thank you.
            </h4>
        </div>
    </div>
    <!-- /.error-content -->
</div>

