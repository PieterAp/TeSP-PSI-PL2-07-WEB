<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

DashboardAsset::register($this);
$userData = $this->params['userData'];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>FixByte Backend</title>
    <?php $this->head() ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo Url::to('@web/images/icons/logo_transparent.png')?>"/>
</head>
<body class="hold-transition skin-black sidebar-mini">
<?php $this->beginBody() ?>

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <?= Html::img(Url::to('@web/images/icons/logo_transparent.png'), ['alt'=>'FixByte Logof', 'class'=>'img-responsive mx-auto', 'style'=>'display:initial;']);?>
                    <br><small>Backend</small>
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <b style="display: inline-flex;">
                        <span style="color: #F44336;">
                            Fix
                        </span>
                        <span style="color: #37a0f4;">
                            Byte
                        </span>
                    </b>
                    Backend</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span><?= $userData->userNomeProprio.' '.$userData->userApelido ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header" style="max-height: 85px;">
                                    <p>
                                        <?= $userData->userNomeProprio.' '.$userData->userApelido ?> - <span style="text-transform: capitalize"><?= array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0]; ?></span>
                                        <small>Member since <?= date('M. Y', Yii::$app->user->identity->created_at) ?></small>
                                    </p>
                                </li>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= Url::to(['user/view', 'id' => Yii::$app->user->getId()]) ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a('Sign out',['site/logout'],['class'=>'btn btn-default btn-flat', 'data' => [
                                                'method' => 'post',
                                            ]]);
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>Main Navigation</b></li>
                    <!-- Optionally, you can add icons to the links -->
                    <li><a href="<?= Url::to(['user/index']); ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
                    <li><a href="<?= Url::to(['categoria/index']); ?>"><i class="fa fa-list"></i> <span>Categories</span></a></li>
                    <li><a href="<?= Url::to(['produto/index']); ?>"><i class="fa fa-th-large"></i> <span>Products</span></a></li>
                    <li class="treeview">
                        <a href="<?= Url::to(['campanha/index']); ?>"><i class="fa fa-link"></i> <span>Sale Campaigns</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                              </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::to(['campanha/index']); ?>">All campaigns</a></li>
                            <li><a href="<?= Url::to(['produtocampanha/index']); ?>">All products in campains</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= Url::to(['compra/historic']); ?>"><i class="fa fa-dollar"></i> <span>Sales</span></a></li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="content_wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $this->title ?>
                </h1>
                <?=
                Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('yii', 'Dashboard'),
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
            </section>



            <!-- Main content -->
            <section class="content">
                <?= $content ?>
            </section>
</div>

        <footer class="main-footer" style="position: relative">
            <div class="pull-right hidden-xs">
                <a href="https://www.ipleiria.pt/" target="_blank">
                    <?= Html::img(Url::to('@web/images/icons/ipl.png'), ['alt'=>'IPL', 'class'=>'img-responsive;', 'style'=>'height: 35px; margin-top: -5px;']);?>
                </a>
            </div>
            <strong>Copyright &copy; 2018-2019
                <b style="display: inline-flex;">
                    <span style="color: #F44336;">
                        Fix
                    </span>
                    <span style="color: #37a0f4;">
                        Byte
                    </span>
                </b>
            </strong>
        </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href != url;
    }).parent().removeClass('active');

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        var stockhref = this.href;
        var stockhref = stockhref.substring(0, stockhref.length - 5);

        if (this.href == url)
        {
            return this.href == url;
        }
        else if ((stockhref + "create" )== url)
        {
            return ((stockhref + "create" )== url);
        }
    }).parent().addClass('active');

/*
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
*/
    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>