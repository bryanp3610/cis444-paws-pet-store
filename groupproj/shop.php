<?php

// A collection of sample products
$products = json_decode('[
		{"id":100,"name":"Dog Alien Toy","image":{"source":"/products/alientoy.png", "width":250,"height":200},"price":"7.00"},
		{"id":101,"name":"Set of 4 Ball Toys","image":{"source":"/products/balls.png","width":250,"height":200},"price":"4.50"},
		{"id":102,"name":"Dog Soft Frisbee Toy","image":{"source":"/products/frisbee.png","width":250,"height":200},"price":"5.00"},
		{"id":103,"name":"Cat Scratch and Roll Toy","image":{"source":"/products/scratchToy.png","width":250,"height":200},"price":"8.50"},
		{"id":104,"name":"Cats Set of 5 Mice Toy for","image":{"source":"/products/mouseToy.png","width":250,"height":200},"price":"3.00"},
		{"id":105,"name":"Cats Bird Toy","image":{"source":"/products/bird toy.png","width":250,"height":200},"price":"3.50"},
		{"id":106,"name":"Cats Lattice Toys","image":{"source":"/products/latticeBall.png","width":250,"height":200},"price":"2.00"},
		{"id":107,"name":"Hamsters Glass Cage","image":{"source":"/products/hamsterCage.png","width":250,"height":200},"price":"50.00"},
		{"id":108,"name":"Hamsters Hay Hut","image":{"source":"/products/hut.png","width":250,"height":200},"price":"7.00"},
		{"id":109,"name":"Hamsters AppleSticks","image":{"source":"/products/appleStick.png","width":250,"height":200},"price":"5.00"},
		{"id":110,"name":"Hamsters Flying Saucer Toy","image":{"source":"/products/flyinSaucer.png","width":250,"height":200},"price":"8.00"},
		{"id":111,"name":"Hamsters Water Feeder","image":{"source":"/products/waterBottle.png","width":250,"height":200},"price":"5.00"},
		{"id":112,"name":"X-Large Dog Bed","image":{"source":"/products/X-Large dog bed.png","width":250,"height":200},"price":"20.00"},
		{"id":113,"name":"All Animals Frog Bed","image":{"source":"/products/frogBed.png","width":300,"height":200},"price":"20.00"},
		{"id":114,"name":"Grey Cat Bed","image":{"source":"/products/grey bed.png","width":250,"height":200},"price":"20.00"},
		{"id":115,"name":"Hamsters Wool Couch Bed","image":{"source":"/products/wool couch bed.png","width":250,"height":200},"price":"15.00"}]');

// Page
$a = (isset($_GET['a'])) ? $_GET['a'] : 'home';

require_once 'class.Cart.php';

// Initialize cart object
$cart = new Cart([
	// Maximum item can added to cart, 0 = Unlimited
	'cartMaxItem' => 0,

	// Maximum quantity of a item can be added to cart, 0 = Unlimited
	'itemMaxQuantity' => 5,

	// Do not use cookie, cart items will gone after browser closed
	'useCookie' => false,
]);

// Shopping Cart Page
if ($a == 'cart') {
	$cartContents = '
	<div class="alert alert-warning">
		<img src="info-icon.png" alt="cart" width="20px" height="20px"> There are no items in the cart.
	</div>';

	// Empty the cart
	if (isset($_POST['empty'])) {
		$cart->clear();
	}

	// Add item
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->add($product->id, $_POST['qty'], [
			'price' => $product->price,
		]);
	}

	// Update item
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->update($product->id, $_POST['qty'], [
			'price' => $product->price,
		]);
	}

	// Remove item
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->remove($product->id, [
			'price' => $product->price,
		]);
	}

	if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();

		$cartContents = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Product</th>
					<th class="col-md-3 text-center">Quantity</th>
					<th class="col-md-2 text-right">Price</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>' . $product->name . ((isset($item['attributes']['color'])) ? ('<p><strong>Color: </strong>' . $colors[$item['attributes']['color']] . '</p>') : '') . '</td>
					<td class="text-center"><div class="form-group"><input type="number" value="' . $item['quantity'] . '" class="form-control quantity pull-left" style="width:100px">
					<div class="pull-right"><button class="btn btn-default btn-update" data-id="' . $id . '" data-color="' . ((isset($item['attributes']['color'])) ? $item['attributes']['color'] : '') . '">
					<img src="refresh.png" alt="cart" width="20px" height="20px"> Update</button><button class="btn btn-danger btn-remove" data-id="' . $id . '" data-color="' . ((isset($item['attributes']['color'])) ? $item['attributes']['color'] : '') . '">
					<img src="trash1.png" alt="cart" width="18px" height="20px"></button></div></div></td>
					<td class="text-right">$' . $item['attributes']['price'] . '</td>
				</tr>';
			}
		}

		$cartContents .= '
			</tbody>
		</table>

		<div class="text-right">
			<h3>Total:<br />$' . number_format($cart->getAttributeTotal('price'), 2, '.', ',') . '</h3>
		</div>

		<p>
			<div class="pull-left">
				<button class="btn btn-danger btn-empty-cart">Empty Cart</button>
			</div>
			<div class="pull-right text-right">
				<a href="?a=home" class="btn btn-default">Continue Shopping</a>
				<a href="?a=checkout" class="btn btn-danger">Checkout</a>
			</div>
		</p>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel = "stylesheet" href="style.css" type="text/css">
		<link href="style2.css" rel="stylesheet">
	

		<style>
			body{margin-top:50px;margin-bottom:200px}
		</style>
	</head>

	<body>
    <div class="navbar">
		<div class="logo">
			<a class="active" href='home.html'><img src="logo2.jpg" alt="logo" width='190.5px'
				height='104px' float='left';></a>
		</div>
		<div class="navcontainer">
			<a class="active" href='home.html'>Home</a>
			<a href="about.html">About Us</a>
			<a href="shop.php">Shop</a>
			<div class="lefts">
			<ul class="nav navbar-nav">
						<li><a href="?a=cart" id="li-cart"><img src="cart-icon.png" alt="cart" width="20px" height="20px"> Cart (<?php echo $cart->getTotalItem(); ?>)</a></li>
					</ul>
				<a href="login.html">Log in</a>
			</div>
		</div>

				</div>
			</div>
		</div>

		<?php if ($a == 'cart'): ?>
		<div class="container">
			<h1>Shopping Cart</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<?php echo $cartContents; ?>
					 </div>
				</div>
			</div>
		</div>
		<?php elseif ($a == 'checkout'): ?>
		<div class="container">
			<h1>Checkout</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
					 	<pre><?php print_r($cart->getItems()); ?></pre>
					 </div>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="container">
			<h1>Products</h1>
			<div class="row">
				<?php
				foreach ($products as $product) {
					echo '
					<div class="col-md-6">
						<h3>' . $product->name . '</h3>

						<div>
							<div class="pull-left">
								<img src="' . $product->image->source . '" border="0" width="' . $product->image->width . '" height="' . $product->image->height . '" title="' . $product->name . '" />
							</div>
							<div class="pull-right">
								<h4>$' . $product->price . '</h4>
								<form>
									<input type="hidden" value="' . $product->id . '" class="product-id" />';

					echo '

									<div class="form-group">
										<label>Quantity:</label>
										<input type="number" value="1" class="form-control quantity" />
									</div>
									<div class="form-group">
										<button class="btn btn-danger add-to-cart"><img src="cart-icon.png" alt="cart" width="20px" height="20px"> Add to Cart</button>
									</div>
								</form>
							</div>
							<div class="clearfix"></div><br><br><br><br>
						</div>
					</div>';
				}
				?>
			</div>
		</div>
		<?php endif; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script>
			$(document).ready(function(){
				$('.add-to-cart').on('click', function(e){
					e.preventDefault();

					var $btn = $(this);
					var id = $btn.parent().parent().find('.product-id').val();
					var color = $btn.parent().parent().find('.color').val() || '';
					var qty = $btn.parent().parent().find('.quantity').val();

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="color" value="' + color + '"><input type="hidden" name="qty" value="' + qty + '">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-update').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var qty = $btn.parent().parent().find('.quantity').val();
					var color = $btn.attr('data-color');

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="'+qty+'"><input type="hidden" name="color" value="'+color+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-remove').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var color = $btn.attr('data-color');

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="color" value="'+color+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-empty-cart').on('click', function(){
					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

					$('body').append($form);
					$form.submit();
				});
			});
		</script>
	</body>
</html>