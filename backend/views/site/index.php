<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
?>

<!-- Info boxes -->
<div class="row">
    <!-- Users & Categories -->
    <div class="col-md-3">
        <div class="box box-default collapsed-box">
            <div class="small-box bg-yellow" style="margin-bottom: 0px">
                <div class="inner">
                    <h3><?= $users['qntUsers'] ?></h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="#" class="small-box-footer" data-widget="collapse">
                    More info <i class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
                <div class="box-footer" style="padding: 0px;">
                    <ul class="nav nav-stacked">
                        <li style="padding: 10px 15px;">Total <span class="pull-right badge"><?= $users['qntUsers'] ?></span></li>
                        <li style="padding: 10px 15px;">Admins <span class="pull-right badge"><?= $users['qntAdmin'] ?></span></li>
                        <li style="padding: 10px 15px;">Employees <span class="pull-right badge"><?= $users['qntMod'] ?></span></li>
                        <li style="padding: 10px 15px;">Clients <span class="pull-right badge"><?= $users['qntClient'] ?></span></li>
                        <li style="padding: 10px 15px;">New <span class="pull-right badge bg-green"><?= $users['qntNew'] ?></span></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-default collapsed-box">
            <div class="small-box bg-red" style="margin-bottom: 0px">
                <div class="inner">
                    <h3><?= $categories['Total']?></h3>

                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="ion-android-list"></i>
                </div>
                <a href="#" class="small-box-footer" data-widget="collapse">
                    More info <i class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
                <div class="box-footer" style="padding: 0px;">
                    <small class="text-justify">(only if categories and sub-categories are visible)</small>

                    <ul class="nav nav-stacked">
                        <li style="padding: 10px 15px;">Categories
                            <ul>
                                <li style="padding: 10px 15px;">Total <span class="pull-right badge"><?= $categories['Total'] ?></span></li>
                                <li style="padding: 10px 15px;">Visible <span class="pull-right badge bg-green"><?= $categories['Show'] ?></span></li>
                                <li style="padding: 10px 15px;">Hidden <span class="pull-right badge bg-red"><?= $categories['Hide'] ?></span></li>

                            </ul>
                        </li>

                        <li style="padding: 10px 15px;">Sub-categories
                            <ul>
                                <li style="padding: 10px 15px;">Total <span class="pull-right badge"><?= $subCategories['Total'] ?></span></li>
                                <li style="padding: 10px 15px;">Visible <span class="pull-right badge bg-green"><?= $subCategories['Show'] ?></span></li>
                                <li style="padding: 10px 15px;">Hidden <span class="pull-right badge bg-red"><?= $subCategories['Hide'] ?></span></li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /Users & Categories/ -->

    <!-- Sales -->
    <div class="col-md-3">
        <div class="box box-default collapsed-box">
            <div class="small-box bg-green" style="margin-bottom: 0px">
                <div class="inner">
                    <h3>150</h3>

                    <p>Sales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-cart-outline"></i>
                </div>
                <a href="#" class="small-box-footer" data-widget="collapse">
                    More info <i class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
                <div class="box-footer" style="padding: 0px;">
                    <ul class="nav nav-stacked">
                        <li style="padding: 10px 15px;">Total <span class="pull-right badge bg-red">842</span></li>
                        <li style="padding: 10px 15px;">Admins <span class="pull-right badge bg-blue">31</span></li>
                        <li style="padding: 10px 15px;">Employees <span class="pull-right badge bg-aqua">5</span></li>
                        <li style="padding: 10px 15px;">Clients <span class="pull-right badge bg-green">12</span></li>
                        <li style="padding: 10px 15px;">Total price <span class="pull-right badge bg-red"><?= $price["total"]?> €</span></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- Sales -->

    <!-- Products -->
    <div class="col-md-3">
        <div class="box box-default collapsed-box">
            <div class="small-box bg-aqua" style="margin-bottom: 0px">
                <div class="inner">
                    <h3><?= $products['qntProducts'] ?></h3>

                    <p>Products</p>
                    <small>(only if product is visible)</small>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                <a href="#" class="small-box-footer" data-widget="collapse">
                    More info <i class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
                <div class="box-footer" style="padding: 0px;">
                    <ul class="nav nav-stacked">
                        <li style="padding: 10px 15px;">Total <span class="pull-right badge"><?= $products['qntProducts'] ?></span></li>
                        <li style="padding: 10px 15px;">New <span class="pull-right badge bg-green"><?= $products['qntNew'] ?></span></li>
                        <li style="padding: 10px 15px;">With discount <span class="pull-right badge"><?= $products['qntDiscount'] ?></span></li>
                        <li style="padding: 10px 15px;">Visible <span class="pull-right badge bg-green"><?= $products['qntVisible'] ?></span></li>
                        <li style="padding: 10px 15px;">Hidden <span class="pull-right badge bg-red"><?= $products['qntInvisible'] ?></span></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- Products -->

    <!-- Sale Campaigns -->
    <div class="col-md-3">
        <div class="box box-default collapsed-box">
            <div class="small-box bg-light-blue" style="margin-bottom: 0px">
                <div class="inner">
                    <h3><?= $sales['Total'] ?></h3>

                    <p>Sale Campaigns</p>
                </div>
                <div class="icon">
                    <i class="ion-ios-pricetags-outline"></i>
                </div>
                <a href="#" class="small-box-footer" data-widget="collapse">
                    More info <i class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
                <div class="box-footer" style="padding: 0px;">
                    <ul class="nav nav-stacked">
                        <li style="padding: 10px 15px;">Total <span class="pull-right badge bg-green"><?= $sales['Total'] ?></span></li>
                        <li style="padding: 10px 15px;">Old <span class="pull-right badge"><?= $sales['Old'] ?></span></li>
                        <li style="padding: 10px 15px;">Current Campaigns<span class="pull-right badge bg-aqua"><?= $sales['Current'] ?></span></li>
                        <li style="padding: 10px 15px;">Current Products <span class="pull-right badge bg-aqua"><?= $productSales['products'] ?></span></li>
                        <li style="padding: 10px 15px;">Coming Up <span class="pull-right badge bg-red"><?= $sales['Coming_Up'] ?></span></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- Sale Campaigns -->
</div>