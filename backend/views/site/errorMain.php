<?php
/**
 * Created by PhpStorm.
 * User: Pieter
 * Date: 20/01/2019
 * Time: 05:49
 */

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = 'Error';
?>
<div class="error-page" style="margin-top: 100px;">
    <h2 class="headline text-yellow" style="margin: 0px;"> <?= $exception->statusCode ?> </h2>

    <div class="error-content" style=" display: flow-root; vertical-align: middle;">
        <h3>
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
                echo  '<i class="fa fa-warning text-red"></i>'.Html::encode($this->title);
            }
            ?>
        </h3>

        <h4>
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
    <div style=" margin-top: 35px;">
        <h4 style="font-family: 'Montserrat', sans-serif;">
            The above error occurred while the Web server was processing your request.

            Please contact us if you think this is a server error.<br><br> Thank you.
        </h4>
    </div>
    <!-- /.error-content -->
</div>