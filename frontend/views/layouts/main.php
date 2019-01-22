<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;


AppAsset::register($this);

$categoriaNavbar = $this->params['categoriaNavbar'];
$categoriaChildNavbar = $this->params['categoriaChildNavbar'];
$sale = $this->params['sale'];
$totalPrice = $this->params['totalPrice'];
$cart = $this->params['cart'];
$this->title = 'FixByte';
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo Url::to('@web/images/icons/logo_transparent.png')?>"/>
</head>
<body class="animsition" style="animation-duration: 1500ms; opacity: 1;">
<header class="header1">
    <div class="wrap_header fixed-header2 trans-0-4" style="opacity=none;">
    <!-- Menu -->
        <?php if ($categoriaNavbar!=null && $categoriaChildNavbar!=null) {
        echo '<div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">';
                foreach ($categoriaNavbar as $keyMain => $valueMain){
                    echo '<li><a href="'.$categoriaNavbar[$keyMain]['url'].'">'.$categoriaNavbar[$keyMain]['label'].'</a>';
                    echo '<ul class="sub_menu">';
                    foreach ($categoriaChildNavbar as $keyChild => $valueChild){
                        if ($categoriaNavbar[$keyMain]['id'] == $categoriaChildNavbar[$keyChild]['id']){
                            echo '<li><a href="'.$categoriaChildNavbar[$keyChild]['childurl'].'">'.$categoriaChildNavbar[$keyChild]['childnome'].'</a></li>';
                        }
                    }
                    echo '</ul></li>';
                }
                echo '
            </ul>
        </nav>
    </div>';}?>
    <!-- Header Icon -->
    <div class="header-icons">
        <!--  -->
        <?php if (Yii::$app->user->isGuest){
            echo '<a href="'.Url::to(['site/login']).'" style="margin-right: 20px;">Sign in</a>
                    <a href="'.Url::to(['site/signup']).'" >Sign up</a>';
        }else{
            echo '<div class="dropdown">
            <a href="#" class="header-wrapicon1 dis-block icon-menu">
                <img src="'.Url::to('@web/images/icons/icon-header-01.png').'" class="header-icon1" alt="ICON"">
            </a>
            <div class="dropdown-content">
                <a href="'.Url::to(['user/update']).'">My Account</a>';
                $ola = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                if (isset($ola['admin']) || isset($ola['funcionario'])){
                    echo '<a href="'.Url::to(['user/backend']).'">Back office</a>';

                }
                echo '<a href="'.Url::to(['compra/historic']).'">History</a>';
                echo '<a href="'.Url::to(['/reparacao/index']).'">Repairs</a>
                <a href="'.Url::to(['site/logout']).'" id="logout" data-method="post">Log out</a>
            </div>
        </div>
        <span class="linedivide1"></span>
        <div class="header-wrapicon2">
            <img src="'.Url::to('@web/images/icons/icon-header-02.png').'" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">'; echo count($cart); echo'</span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown" style="overflow-y: auto;max-height: 320px;">
                <ul class="header-cart-wrapitem">';
                if (isset($cart)){
                    foreach ($cart as $key => $value){
                        echo '<li class="header-cart-item values'.$cart[$key]['idprodutos'].'">';?>
                            <?= Html::a('
                             <div class="header-cart-item-img text-center" style="display: table-cell;">
                                <img href ="#" src="'.Url::to('@web/images/products/'.$cart[$key]['idprodutos'].'/'.$cart[$key]['produtoImagem1']).'" alt="IMG" style="max-width: 55px; max-height: 55px; margin: auto;">
                             </div>
                            ',null,['onclick' => 'compraDeleteAJAX("'.Yii::$app->request->baseUrl.'","'.$cart[$key]['idprodutos'].'","'.Yii::$app->request->getCsrfToken().'")']);?>
                                <?php echo '<div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">';
                                        echo $cart[$key]['produtoNome'];
                                    echo '</a>
                                        <span class="header-cart-item-info">';
                                            echo $cart[$key]['produto_preco'];
                                    echo '</span>
                                </div>
                            </li>';
                    }
                };
            echo'</ul>';
                if(isset($totalPrice['compraValor'])){
                    echo '<div class="header-cart-total total">';
                    echo 'Total: ' . $totalPrice['compraValor'].'€';
                    echo '</div>';
                }
            echo '<div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="'.Url::to(['/compra/cart']).'" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            CheckOut
                        </a>
                    </div>
                </div>
            </div>
        </div>';
        }?>
    </div>
</div>
<!-- top noti -->
    <?php if(isset($sale) or $sale == null){
        echo '<div class="flex-c-m size22 bg0 s-text21 pos-relative">';
        echo 'Check our '.$sale['campanhaNome'].' sale, until '.$sale['campanhaDataFim'] ;
    }
    echo '<a href="'.Url::to(['/campanha/produtocampanha', 'id' => $sale['idCampanha'], 'limit' => 9]).'" class="s-text22 hov6 p-l-5">See</a>
    <button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
        <i class="fa fa-remove fs-13" aria-hidden="true"></i>
    </button>
</div>';?>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-24">
        <div class="topbar2">
            <!-- Logo2 -->
            <a href="<?php echo Yii::$app->homeUrl?>" class="logot">
                <b style="display: inline-flex;">
                    <span class="md-red-500">
                        Fix
                    </span>
                    <span class="md-blue-500">
                     Byte
                    </span>
                </b>
            </a>
            <form style="width:100%;padding-right: 380px;">
                <input type="text" name="search">
            </form>
            <div class="topbar-child2">
            <?php if (Yii::$app->user->isGuest){
                echo '<a href="'.Url::to(['site/login']).'" style="margin-right: 20px;">Sign in</a>
                <a href="'.Url::to(['site/signup']).'" >Sign up</a>';

            }else{
                echo'<div class="dropdown">
                    <a href="#" class="header-wrapicon1 dis-block icon-menu">
                        <img src="'.Url::to('@web/images/icons/icon-header-01.png'),'" class="header-icon1" alt="ICON"">
                    </a>
                    <div class="dropdown-content">
                        <a href="'.Url::to(['user/update']).'">My Account</a>';
                        $ola = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                        if (isset($ola['admin']) || isset($ola['funcionario'])){
                            echo '<a href="'.Url::to(['user/backend']).'">Back office</a>';

                        }
                        echo '<a href="'.Url::to(['compra/historic']).'">History</a>';
                        echo '<a href="'.Url::to(['/reparacao/index']).'">Repair</a>
                        <a href="'.Url::to(['site/logout']).'" data-method="post" >Log out</a>
                    </div>
                </div>
                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">
                    <img src="'.Url::to('@web/images/icons/icon-header-02.png').'" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">';echo count($cart); echo '</span>
                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown" style="overflow-y: auto;max-height: 320px;">
                        <ul class="item">';
                            if (isset($cart)){
                                foreach ($cart as $key => $value){
                                    echo '<li class="header-cart-item values'.$cart[$key]['idprodutos'].'">';?>
                                    <?= Html::a('
                                    <div class="header-cart-item-img text-center" style="display: table-cell;">
                                        <img href ="#" src="'.Url::to('@web/images/products/'.$cart[$key]['idprodutos'].'/'.$cart[$key]['produtoImagem1']).'" alt="IMG"  style="max-width: 55px; max-height: 55px; margin: auto;">
                                     </div>
                                    ',null,['onclick' => 'compraDeleteAJAX("'.Yii::$app->request->baseUrl.'","'.$cart[$key]['idprodutos'].'","'.Yii::$app->request->getCsrfToken().'")']);?>
                                            <?php echo '<div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name">';
                                            echo $cart[$key]['produtoNome'];
                                            echo '</a>
                                                <span class="header-cart-item-info">';
                                            echo $cart[$key]['produto_preco'];
                                            echo '</span>
                                        </div>
                                    </li>';
                                }
                            };
                        echo'</ul>';
                            if(isset($totalPrice['compraValor'])){
                                echo '<div class="header-cart-total total">';
                                echo 'Total: ' . $totalPrice['compraValor'].'€';
                                echo '</div>';
                            }
                        echo '<div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="'.Url::to(['/compra/cart']).'" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        CheckOut
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>';
            }?>

            </div>
        </div>
        <?php if ($categoriaNavbar!=null && $categoriaChildNavbar!=null) {
        echo '<div class="wrap_header">
            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">';
                        foreach ($categoriaNavbar as $keyMain => $valueMain){
                            echo '<li><a id="ola" href="'.$categoriaNavbar[$keyMain]['url'].'">'.$categoriaNavbar[$keyMain]['label'].'</a>';
                            echo '<ul class="sub_menu">';
                            foreach ($categoriaChildNavbar as $keyChild => $valueChild){
                                if ($categoriaNavbar[$keyMain]['id'] == $categoriaChildNavbar[$keyChild]['id']){
                                    echo '<li><a href="'.$categoriaChildNavbar[$keyChild]['childurl'].'">'.$categoriaChildNavbar[$keyChild]['childnome'].'</a></li>';

                                }
                            }
                            echo '</ul></li>';
                        }
                        echo '
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>';
       }?>
    </div>
    <div class="wrap_header_mobile"     style="max-height: 0;">
        <!-- Logo moblie -->
        <a href="<?php echo Yii::$app->homeUrl?>" style="font-size: 25px">
            <b style="display: inline-flex;">
                    <span class="md-red-500">
                        Fix
                    </span>
                    <span class="md-blue-500">
                     Byte
                    </span>
            </b>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <?php if (Yii::$app->user->isGuest){
                    echo '<a href="'.Url::to(['site/login']).'" style="margin-right: 20px;">Sign in</a>
                    <a href="'.Url::to(['site/signup']).'" >Sign up</a>';
                }else{
                    echo '<div class="dropdown">
                    <a href="#" class="header-wrapicon1 dis-block icon-menu">
                        <img src="'.Url::to('@web/images/icons/icon-header-01.png').'" class="header-icon1" alt="ICON"">
                    </a>
                    <div class="dropdown-content">
                        <a href="'.Url::to(['user/update']).'">Minha conta</a>
                        '; $ola = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                             if (isset($ola['admin']) || isset($ola['funcionario'])){
                                    echo '<a href="'.Url::to(['user/backend']).'">Back office</a>';

                             }
                        echo '<a href="'.Url::to(['compra/historic']).'">History</a>';
                        echo '<a href="'.Url::to(['/reparacao/index']).'">Repair</a>
                        <a href="'.Url::to(['site/logout']).'" data-method="post" >Log out</a>
                    </div>
                </div>';
                echo '<span class="linedivide2"></span>';
                echo '<div class="header-wrapicon2">
                    <img src="'.Url::to('@web/images/icons/icon-header-02.png').'" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">';echo count($cart); echo '</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown" style="max-height: 320px;overflow-y: auto;">

                        <ul class="header-cart-wrapitem" style="overflow: hidden;">';
                            if (isset($cart)){
                                foreach ($cart as $key => $value){
                                    echo '<li class="header-cart-item values'.$cart[$key]['idprodutos'].'">';?>
                                    <?= Html::a('
                                     <div class="header-cart-item-img">
                                        <img href ="#" src="'.Url::to('@web/images/products/'.$cart[$key]['idprodutos'].'/'.$cart[$key]['produtoImagem1']).'" alt="IMG">
                                     </div>
                                    ',null,['onclick' => 'compraDeleteAJAX("'.Yii::$app->request->baseUrl.'","'.$cart[$key]['idprodutos'].'","'.Yii::$app->request->getCsrfToken().'")']);?>
                                            <?php echo '<div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name">';
                                            echo $cart[$key]['produtoNome'];
                                            echo '</a>
                                                <span class="header-cart-item-info">';
                                            echo $cart[$key]['produto_preco'];
                                            echo '</span>
                                        </div>
                                    </li>';
                                }
                            };
                        echo '</ul>';
                            if(isset($totalPrice['compraValor'])){
                                echo '<div class="header-cart-total total">';
                                echo 'Total: ' . $totalPrice['compraValor'].'€';
                                echo '</div>';
                            }
                        echo '<div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="'.Url::to(['/compra/cart']).'" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        CheckOut
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>';
                }?>
            </div>
            <div class="btn-show-menu-mobile hamburger">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">
                <form style="width:100%">
                    <input type="text" name="search">
                </form>
                <?php if ($categoriaNavbar!=null && $categoriaChildNavbar!=null) {

                    foreach ($categoriaNavbar as $keyMain => $valueMain){
                        echo '<li class="item-menu-mobile">';
                        echo '<a href="'.$categoriaNavbar[$keyMain]['url'].'">'.$categoriaNavbar[$keyMain]['label'].'</a>';
                        echo '<ul class="sub-menu">';
                        foreach ($categoriaChildNavbar as $keyChild => $valueChild){
                            if ($categoriaNavbar[$keyMain]['id'] == $categoriaChildNavbar[$keyChild]['id']){
                                echo '<li><a href="'.$categoriaChildNavbar[$keyChild]['childurl'].'">'.$categoriaChildNavbar[$keyChild]['childnome'].'</a></li>';
                            }
                        }
                        echo '</ul>
                            <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                            </li>';
                    }
                    echo '
            </ul>
        </nav>
    </div>';

    }?>

</header>




<!--===============================================================================================-->
<script src="js/main.js"></script>

<div class="container" style="margin-left: 0px;
    margin-right: 0px;
    max-width: 100%;
    padding-left: 0px;
    padding-right: 0px;">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

    <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="t-center p-l-15 p-r-15">
            <div class="t-center p-l-15 p-r-15">
                <a href="#">
                    <img class="h-size2" src="<?= Url::to('@web/images/icons/paypal.png') ?>" alt="IMG-PAYPAL">
                </a>

                <a href="#">
                    <img class="h-size2" src="<?= Url::to('@web/images/icons/visa.png') ?>" alt="IMG-VISA">
                </a>

                <a href="#">
                    <img class="h-size2" src="<?= Url::to('@web/images/icons/mastercard.png') ?>" alt="IMG-MASTERCARD">
                </a>

                <a href="#">
                    <img class="h-size2" src="<?= Url::to('@web/images/icons/express.png') ?>" alt="IMG-EXPRESS">
                </a>

                <a href="#">
                    <img class="h-size2" src="<?= Url::to('@web/images/icons/discover.png') ?>" alt="IMG-DISCOVER">
                </a>
                <div class="t-center s-text8 p-t-20">
                    Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>.
                    Adapted by
                    <b style="display: inline-flex;">
                        <span style="color: #F44336;">
                            Fix
                        </span>
                        <span style="color: #37a0f4;">
                            Byte
                        </span>
                    </b>
                    2018-2019
            </div>
    </footer>
    <div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
    </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
