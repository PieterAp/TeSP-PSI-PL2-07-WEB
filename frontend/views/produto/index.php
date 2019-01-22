<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>


<body class="animsition">
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container" style="max-width: 90%;">
			<div class="row">
                <!-- Left Sidebar -->
                <div class="col-sm-5 col-md-3 col-lg-2 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="#" class="s-text13 active1">
									All
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Women
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Men
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Kids
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Accesories
								</a>
							</li>
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filters
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Price
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filter
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						<div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Color
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
						</div>
					</div>
				</div>
                <!-- /Left Sidebar/ -->

                <!-- Main -->
				<div class="col-sm-6 col-md-8 col-lg-10 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="control-group">

							<div class="row">
								<div class="col-md-6">
									<select class="m-r-10 m-b-5 w-size12 bo4 selecter" name="sorting">
										<option>Default Sorting</option>
										<option>Popularity</option>
										<option>Price: low to high</option>
										<option>Price: high to low</option>
									</select>
								</div>
								<div class="col-md-6">
									<select class="m-r-10 m-b-5 w-size12 bo4 selecter" name="sorting">
										<option>Price</option>
										<option>$0.00 - $50.00</option>
										<option>$50.00 - $100.00</option>
										<option>$100.00 - $150.00</option>
										<option>$150.00 - $200.00</option>
										<option>$200.00+</option>

									</select>
								</div>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Showing <?= count($products) ?> results
						</span>
					</div>

					<!-- Product listing -->
                    <div class="row">
                        <?php
                        if ($products!=null)
                        {
                            foreach ($products as $key=>$eachProduct)
                            {

                                echo '
                                <div class="col-sm-12 col-md-6 col-lg-2 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                        ';
                                if ($eachProduct['campanhaPercentagem']==null)
                                {
                                    echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-label">';
                                }
                                elseif ($eachProduct['campanhaPercentagem']!=null)
                                {
                                    echo '<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">';

                                }
                                $imgPath = Url::to('@web/images/products/'.$eachProduct['idprodutos'].'/'.$eachProduct['produtoImagem1']);
                                echo '<div class="imageResize">';
                                echo Html::img($imgPath, ['alt'=>'some', 'class'=>'img-responsive']);
                                echo '</div>';
                                echo'                                              
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="'.Url::to(['compra/create', 'id' => $eachProduct['idprodutos']]).'">
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.Url::to(['produto/view', 'id' => $eachProduct['idprodutos']]).'" class="block2-name dis-block s-text3 p-b-5">
                                        '.$eachProduct['produtoNome'].'
                                    </a>';
                                if ($eachProduct['precoDpsDesconto']==null)
                                {
                                    echo '
                                        										<span class="block2-price m-text6 p-r-5">
											'.$eachProduct['produtoPreco'].'€
										</span>
                                        ';
                                }
                                else
                                {
                                    echo '
                                                                        <span class="block2-oldprice m-text7 p-r-5">
											'.$eachProduct['produtoPreco'].'€
                                    </span>

                                    <span class="block2-newprice m-text8 p-r-5">
											'.$eachProduct['precoDpsDesconto'].'€
									</span>
                                    ';
                                }echo'
                                </div>
                            </div>
                        </div>
                                
                                
                                
                                ';
                            }
                        }
                        else
                        {
                            echo '<h2 style="color: red;">No products found</h2>';
                        }
                        ?>
                    </div>

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'activePageCssClass' => 'active-pagination',
                            'firstPageLabel' => 'first',
                            'lastPageLabel' => 'last',
                            'prevPageLabel' => 'previous',
                            'nextPageLabel' => 'next',
                            'options' => [
                                'tag' => 'a',
                                'class' => 'item-pagination flex-c-m trans-0-4'
                            ]
                        ]);
                        ?>
                        <!--
                            <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                            <a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
                        -->
					</div>
				</div>
                <!-- /Main/ -->
            </div>
		</div>
	</section>

	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
	<script type="text/javascript">
		var filterBar = document.getElementById('filter-bar');

		noUiSlider.create(filterBar, {
			start: [ 50, 200 ],
			connect: true,
			range: {
				'min': 50,
				'max': 200
			}
		});

		var skipValues = [
			document.getElementById('value-lower'),
			document.getElementById('value-upper')
		];

		filterBar.noUiSlider.on('update', function( values, handle ) {
			skipValues[handle].innerHTML = Math.round(values[handle]) ;
		});
	</script>