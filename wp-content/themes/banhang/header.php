<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/libs/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/child.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/responsive.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- Latest compiled and minified CSS & JS -->



</head>

<body <?php body_class(); ?>>
	<div id="wallpaper">
		<header>
			<div class="top">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<p>Chào mừng đến với shop bán hàng!</p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="top-menu">
								<?php wp_nav_menu(
									array(
										'theme_location' => 'header-top',
										'container' => 'false',
										'menu_id' => 'header-top',
										'menu_class' => 'header-top',
									)
								); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="main-header">
				<div class="container">
					<div class="row">
						<div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3 order-md-0 order-0">
							<div class="logo">
								<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"></a>
								<h3><?php bloginfo('name'); ?></h1>
							</div>
						</div>
						<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 order-md-1 order-2">
							<div class="form-seach-product">
								<form action="<?php bloginfo('url'); ?>" method="GET" role="form">
									<select name="term" id="input" class="form-control" required="required">
										<option value="0">Chọn danh mục</option>
										<?php
										$vnkings_terms = get_terms('product_cat', 'orderby=name');
										foreach ($vnkings_terms as $term) :
											echo "<option value='" . $term->slug . "'" . ($_GET['publication_categories'] == $term->slug ? ' selected="selected"' : '') . ">" . $term->name . "</option>\n";
										endforeach;
										?>
									</select>
									<div class="input-seach">
										<input type="text" placeholder="Tìm kiếm..." value="" name="s" class="form-control">
										<input type="hidden" name="post_type" value="product">
										<input type="hidden" name="taxonomy" value="product_cat">
										<button type="submit" class="btn-search-pro"><i class="fa fa-search"></i></button>
									</div>
									<div class="clear"></div>
								</form>
							</div>
						</div>
						<div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3 order-md-2 order-1" style="text-align: right">
							<a href="<?php bloginfo('url') ?>/gio-hang" class="icon-cart">
								<div class="icon">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									<span><?php foreach ( WC()->cart->get_cart() as $cart_item ) {  
   $quantity +=  $cart_item['quantity'];
   
} echo $quantity;?></span>
								</div>
								<div class="info-cart">
									<p>Giỏ hàng</p>
									<span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
								</div>
								<span class="clear"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="main-menu-header">
				<div class="container">
					<div id="nav-menu">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'header-main',
								'container' => 'false',
								'menu_id' => 'header-main',
								'menu_class' => 'header-main',
							)
						); ?>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</header>