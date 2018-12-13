<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.min.css',
        //'css/util.css',
        'css/util.min.css',
        'animate/animate.css',
        //'animsition/css/animsition.css',
        'animsition/css/animsition.min.css',
        //'bootstrap/css/bootstrap.css',
        'bootstrap/css/bootstrap.min.css',
        //'bootstrap/css/bootstrap-grid.css',
        'bootstrap/css/bootstrap-grid.min.css',
        'bootstrap/css/bootstrap-reboot.css',
        //'css-hamburgers/hamburgers.css',
        'css-hamburgers/hamburgers.min.css',
        'daterangepicker/daterangepicker.css',
        //'lightbox2/css/lightbox.css',
        //'lightbox2/css/lightbox.min.css',
        //'noui/nouislider.css',
        'noui/nouislider.min.css',
        'perfect-scrollbar/perfect-scrollbar.css',
        //'select2/select2.css',
        'select2/select2.min.css',
        'slick/slick.css',
        //'fonts/font-awesome-4.7.0/css/font-awesome.css',
        'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'css/main.css',
        'css/popupInterface.css'
    ];
    public $js = [
        //'jquery/jquery-3.2.1.min.js',
        'slick/slick.js',
        //'animsition/js/animsition.js',
        'animsition/js/animsition.min.js',
        //'bootstrap/js/popper.js',
        'bootstrap/js/popper.min.js',
        //'bootstrap/js/tooltip.js',
        'bootstrap/js/bootstrap.min.js',
        'countdowntime/countdowntime.js',
        'daterangepicker/daterangepicker.js',
        //'daterangepicker/moment.js',
        'daterangepicker/moment.min.js',
        'isotope/isotope.pkgd.min.js',
        //'js/main.js',
        'js/main.min.js',
        //'js/map-custom.min.js',
        //'js/map-custom.js',
        'js/slick-custom.js',
        //'js/slick-custom.min.js',
        //'lightbox2/js/lightbox.js',
        //'lightbox2/js/lightbox.min.js',
        //'lightbox2/js/lightbox-plus-jquery.js',
        //'lightbox2/js/lightbox-plus-jquery.min.js',
        //'noui/nouislider.js',
        'noui/nouislider.min.js',
        'parallax100/parallax100.js',
        'perfect-scrollbar/perfect-scrollbar.min.js',
        //'select2/select2.js',
        'select2/select2.min.js',
        //'slick/slick.min.js',
        //'sweetalert/sweetalert.min.js',
        'js/common.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
