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
    <link rel="shortcut icon" type="image/png" href="../web/images/icons/logo_transparent.png"/>
</head>
<body class="animsition" style="animation-duration: 1500ms; opacity: 1;">
<header class="header1">
    <div class="wrap_header fixed-header2 trans-0-4" style="opacity=none;">
    <!-- Menu -->
    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li>
                    <a href="<?php echo Url::to(['/site/index'])?>">Home</a>
                    <ul class="sub_menu"> <!--------------------------------------------------------- MENU DO SCROOLL    ------------------------------------------------->
                        <li><a href="<?php echo Url::to(['/site/signin'])?>">Sign in</a></li>
                        <li><a href="<?php echo Url::to(['/site/signup'])?>">Sign up</a></li>
                        <li><a href="<?php echo Url::to(['/site/cart'])?>">Homepage V3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo Url::to(['/site/product'])?>">Products</a>
                </li>
                <li class="sale-noti">
                    <a href="<?php echo Url::to(['/site/product'])?>">Products</a>
                </li>
                <li>
                    <a href="<?php echo Url::to(['/site/about'])?>">About</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Header Icon -->
    <div class="header-icons">
        <!--  -->
        <a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a>
        <a href="#" data-toggle="modal" data-target="#signup-modal">Sign up</a>
        <div class="dropdown">
            <a href="#" class="header-wrapicon1 dis-block icon-menu">
                <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON"">
            </a>
            <div class="dropdown-content">
                <a href="#">Minha conta</a>
                <a href="#">Back office</a>
                <a href="<?php echo Url::to(['/site/cart'])?>">Reparações</a>
                <a href="#">Log out</a>
            </div>
        </div>
        <span class="linedivide1"></span>
        <div class="header-wrapicon2">
            <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">0</span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
                <ul class="header-cart-wrapitem">
                    <li class="header-cart-item">
                        <div class="header-cart-item-img">
                            <img src="images/item-cart-01.jpg" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name">
                                White Shirt With Pleat Detail Back
                            </a>

								<span class="header-cart-item-info">
									1 x $19.00
								</span>
                        </div>
                    </li>

                    <li class="header-cart-item">
                        <div class="header-cart-item-img">
                            <img src="images/item-cart-02.jpg" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name">
                                Converse All Star Hi Black Canvas
                            </a>

								<span class="header-cart-item-info">
									1 x $39.00
								</span>
                        </div>
                    </li>

                    <li class="header-cart-item">
                        <div class="header-cart-item-img">
                            <img src="images/item-cart-03.jpg" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name">
                                Nixon Porter Leather Watch In Tan
                            </a>

								<span class="header-cart-item-info">
									1 x $17.00
								</span>
                        </div>
                    </li>
                </ul>

                <div class="header-cart-total">
                    Total: $75.00
                </div>

                <div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="<?php echo Url::to(['/site/cart'])?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            View Cart
                        </a>
                    </div>

                    <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- top noti -->
<div class="flex-c-m size22 bg0 s-text21 pos-relative">
    20% off everything!
    <a href="<?php echo Url::to(['/site/product'])?>" class="s-text22 hov6 p-l-5">
        Shop Now
    </a>

    <button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
        <i class="fa fa-remove fs-13" aria-hidden="true"></i>
    </button>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-24">
        <div class="topbar2">

            <!-- Logo2 -->
            <a href="<?php echo Url::to(['/site/index'])?>" class="logot">
                <b>
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
                <a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a>
                <a href="#" data-toggle="modal" data-target="#signup-modal">Sign up</a>
                <div class="dropdown">
                    <a href="#" class="header-wrapicon1 dis-block icon-menu">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON"">
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Minha conta</a>
                        <a href="#">Back office</a>
                        <a href="<?php echo Url::to(['/site/repair'])?>">Reparações</a>
                        <a href="#">Log out</a>
                    </div>
                </div>
                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-01.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        White Shirt With Pleat Detail Back
                                    </a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-02.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">Converse All Star Hi Black Canvas</a>
                                    <span class="header-cart-item-info">1 x $39.0></span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-03.jpg" alt="IMG">
                                </div>
                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">Nixon Porter Leather Watch In Tan</a>
                                    <span class="header-cart-item-info">1 x $17.00</span>
                                </div>
                            </li>
                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="<?php echo Url::to(['/site/cart'])?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    CheckOut
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="<?php echo Url::to(['/site/index'])?>">Home</a>
                            <ul class="sub_menu"><!----------------------------------      menu top fixo                    --------------------------->
                                <li><a href="<?php echo Url::to(['/site/signin'])?>">sign in</a></li>
                                <li><a href="<?php echo Url::to(['/site/signup'])?>">sign up</a></li>
                                <li><a href="<?php echo Url::to(['/site/product'])?>">Homepage V3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['/site/product'])?>">Product</a>
                        </li>

                        <li>
                            <a href="<?php echo Url::to(['/site/about'])?>">About</a>
                        </li>

                        <li>
                            <a href="<?php echo Url::to(['/site/productdetail'])?>">Product detail test</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>
    <div class="wrap_header_mobile"     style="max-height: 0;">
        <!-- Logo moblie -->
        <a href="<?php echo Url::to(['/site/index'])?>" style="font-size: 25px">
            <b>
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

                <div class="dropdown">
                    <a href="#" class="header-wrapicon1 dis-block icon-menu">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON"">
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Minha conta</a>
                        <a href="#">Back office</a>
                        <a href="<?php echo Url::to(['/site/repair'])?>">Reparações</a>
                        <a href="#">Log out</a>
                    </div>
                </div>


                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-01.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        White Shirt With Pleat Detail Back
                                    </a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-02.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                    </a>

										<span class="header-cart-item-info">
											1 x $39.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-03.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Nixon Porter Leather Watch In Tan
                                    </a>

										<span class="header-cart-item-info">
											1 x $17.00
										</span>
                                </div>
                            </li>
                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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



                <li class="item-menu-mobile">
                    <a href="index.html">Home</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo Url::to(['/site/signin'])?>">Sign in</a></li>
                        <li><a href="<?php echo Url::to(['/site/signup'])?>">Sign up</a></li>
                        <li><a href="<?php echo Url::to(['/site/cart'])?>">Homepage V3</a></li>
                    </ul>
                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li class="item-menu-mobile">
                    <a href="<?php echo Url::to(['/site/product'])?>">Products</a>
                </li>
                <li class="item-menu-mobile">
                    <a href="<?php echo Url::to(['/site/product'])?>">Products</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="<?php echo Url::to(['/site/about'])?>">About</a>
                </li>
            </ul>
        </nav>
    </div>
</header>




<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
    <?php $this->endBody() ?>
    </body>
</html>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form>
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>

            <div class="login-help">
                <a href="#" id="login">Sign Up</a>  -  <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Sign up</h1><br>
            <form>
                <input type="text" name="firstname" placeholder="First name">
                <input type="text" name="lastname" placeholder="Last name">
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <input type="password" name="confirmpass" placeholder="Password">
                <input class="email" type="email" name="email" placeholder="Email">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>
            <div class="login-help">
                <a href="index.php">Go to Login</a>
            </div>
        </div>
    </div>
</div>
<?php $this->endPage() ?>
