<?php use yii\helpers\Html;
use yii\helpers\Url; ?>
	<!-- Title Page -->

<?php

if (isset($_GET['nostock'])){
	$nostock = $_GET['nostock'];
	echo '
	<div class="alert alert-warning">
		<strong>Warning!</strong> The flowing products has no stock and as been deleted from cart:<br>';
	foreach ($nostock as $key => $value){
		echo $nostock[$key].'<br>';
	}
	echo '</div>';
}
?>

<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?php echo Url::to('@web/images/heading-pages-01.jpg')?>);">
	<h2 class="l-text2 t-center  text-primary">
		Cart
	</h2>
</section>
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100" >
	<div class="container">
		<!-- Cart item -->
		<div class="container-table-cart pos-relative newtable ">
			<div class="wrap-table-shopping-cart bgwhite newtable" >
				<table class="table-shopping-cart newtable">
					<tr class="table-head">
						<th class="column-1"></th>
						<th class="column-2">Product</th>
						<th class="column-3">Price</th>
					</tr>
					<?php
					foreach ($cart as $key => $value){
						echo '<tr class="table-row values'.$key.'">
						<td class="column-1">';?>
						<?= Html::a('
							 <div class="cart-img-product b-rad-4 o-f-hidden">
								<img href ="#" src="'.Url::to('@web/images/products/'.$cart[$key]['idprodutos'].'/'.$cart[$key]['produtoImagem1']).'" alt="IMG">
							 </div>
							',null,['onclick' => 'compraDeleteAJAX("'.Yii::$app->request->baseUrl.'","'.$key.'","'.Yii::$app->request->getCsrfToken().'")']);?>
						<?php echo '</td>
						<td class="column-2">'.$cart[$key]['produtoNome'].'</td>
						<td class="column-3">'.$cart[$key]['produto_preco'].'€</td>
					</tr>';
					}
					?>
				</table>
			</div>
		</div>
		<div class="flex-w flex-sb-m p-b-15 bo8 p-l-35 p-r-60 p-lr-15-sm newtable ">
			<div class="size15 trans-0-4 " style="width:25%;min-width: 150px">
				<!-- Button -->
				<?php

				$ok = sizeof($cart);

				for ($i=0;$i<$ok;$i++){
					if ($cart[$i]['produtoStock']>0){
						$va = 1;
					}
				}
				if(isset ($total) && isset ($va)){
					?>
					<?= Html::a('Conclude Purchase', ['compra/purchase'], ['class' => 'flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 comprabuttom']);

					echo '</div><div class="size10 trans-0-4 m-b-10 checkout" style="min-width: 170px"">
						<!-- Button -->

						<div class="flex-w flex-sb-m p-t-20 p-l-15 p-b-20">
							<span class="m-text22 w-size19 w-full-sm">
								Total:
							</span>
							<span class="m-text21 w-size20 w-full-sm total">'
								.$total->compraValor. '€
							</span>
						</div>
					</div>';
				}
				?>

		</div>
	</div>
</section>
<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45" style="float:none">
	<div class="t-center p-l-15 p-r-15">
		<a href="#">
			<img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
		</a>
		<a href="#">
			<img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
		</a>
		<a href="#">
			<img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
		</a>
		<a href="#">
			<img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
		</a>
		<a href="#">
			<img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
		</a>
		<div class="t-center s-text8 p-t-20">
			Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
		</div>
	</div>
</footer>
<div class="btn-back-to-top bg0-hov" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</span>
</div>
