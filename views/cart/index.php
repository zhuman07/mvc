<?php include ROOT.'/views/layouts/header.php'; ?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Список товаров</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Товар</td>
							<td class="description"></td>
							<td class="price">Цена</td>
							<td class="quantity">Количество</td>
							<td class="total">Общ. стоимость</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($products)): ?>
					<?php foreach ($products as $product): ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo Product::getImage($product['id']) ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $product['name'] ?></a></h4>
								<p>Код товара: <?php echo $product['code'] ?></p>
							</td>
							<td class="cart_price">
								<p>$<?php echo $product['price'] ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="/cart/add/<?php echo $product['id'] ?>" > + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $productsInCart[$product['id']] ?>" autocomplete="off" size="2">
									<a href="/cart/del/<?php echo $product['id'] ?>" class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<?php echo $product['total'] ?></p>
							</td>
							<td class="cart_delete">
								<a href="/cart/delete/<?php echo $product['id'] ?>" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td><h4>Итоговая стоимость</h4></td>
							<td><p class="cart_total_price"><?php if(isset($totalPrice)) echo $totalPrice.'$'; else{ } ?></p></td>
							<td><a href="/cart/checkout">Оформить заказ</a></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<?php include ROOT.'/views/layouts/footer.php'; ?>