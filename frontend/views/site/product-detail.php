<!DOCTYPE html>
<?php
use yii\helpers\Url;
?>
<body class="animsition">
	<div class="container bgwhite p-t-35">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					<div class="slick3">
						<div class="item-slick3" data-thumb="<?php echo Url::to('@web/images/product-detail-02') ?>" style="height:auto;">
							<div class="wrap-pic-w">
								<img src="<?php
                                echo Url::to('@web/images/product-detail-02.jpg') ?>" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="<?php
                        echo Url::to('@web/images/product-detail-02.jpg') ?>" style="max-height: 450px">
							<div class="wrap-pic-w">
								<img src="<?php
                                echo Url::to('@web/images/product-detail-02.jpg') ?>" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="<?php
                        echo Url::to('@web/images/product-detail-02.jpg') ?>" style="max-height: 450px">
							<div class="wrap-pic-w">
								<img src="<?php
                                echo Url::to('@web/images/product-detail-02.jpg') ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-140 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					Boxy T-Shirt with Roll Sleeve Detail
				</h4>

				<span class="m-text17">
					$22
				</span>

				<p class="s-text8 p-t-10">
					Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
				</p>

				<!--  -->
				<div class="p-t-20 p-b-60">
					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Color
						</div>

							<select class="m-r-10 m-b-5 w-size12 bo4 selecter" name="sorting">
								<option>Choose an option</option>
								<option>Gray</option>
								<option>Red</option>
								<option>Black</option>
								<option>Blue</option>
							</select>
					</div>
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content m-t-20" style="max-width: 1000px;
    margin-left: 25%;    margin-right: 25%;">
		<h5 class="flex-sb-m cs-pointer m-text19 color0-hov trans-0-4 dropdown1">
			Description
			<i class="up-mark fs-12 color1 fa fa-plus plus1" aria-hidden="true"></i>
		</h5>

		<div class="dropdown-content dis-none p-t-15 p-b-23 down1">
			<p class="s-text8">
				Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
			</p>
		</div>
	</div>

	<div class="wrap-dropdown-content bo7 p-t-15 p-b-14" style="max-width: 1000px;
    margin-left: 25%;margin-right: 25%;;">
		<h5 class="flex-sb-m cs-pointer m-text19 color0-hov trans-0-4 dropdown2">
			Additional information
			<!--<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>-->
			<i class="up-mark fs-12 color1 fa fa-plus plus2" aria-hidden="true"></i>
		</h5>

		<div class="dropdown-content dis-none p-t-15 p-b-23 down2">
			<p class="s-text8">
				Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
			</p>
		</div>
	</div>

	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
