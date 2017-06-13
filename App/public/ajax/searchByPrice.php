<?php

	if (isset($_POST["min"]) && isset($_POST["max"])) {

		//echo "ok";
		//echo "<script>e=window.alert('ok')</script>";
		$json_data['min'] = $_POST["min"];
		$json_data['max'] = $_POST["max"];
		$json_data['exists'] = true;

		$json_data['html'] = '<div class="col-sm-12">
						<div class="featured_head align-center ">
							<h3>Sort By Price</h3>
						</div>
					</div>

					<div class="col-sm-12 featured_products">

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="/single"><img class="img-responsive" src="/images/featured_products/product1.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$20</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>
						</div>

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="#"><img class="img-responsive" src="/images/featured_products/product2.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$30</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>
						</div>

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="#"><img class="img-responsive" src="/images/featured_products/product3.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$50</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>

						</div>

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="#"><img class="img-responsive" src="/images/featured_products/product4.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$120</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>

						</div>

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="#"><img class="img-responsive" src="/images/featured_products/product5.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$150</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>
						</div>

						<div class="col-sm-4 single_product">
							<div class="col-sm-12">
								<a href="#"><img class="img-responsive" src="/images/featured_products/product6.jpg"></a>
							</div>
							<div class="col-sm-12 product_price">
								<h3 class="align-center">Price : <span>$200</span></h3>
							</div>
							<div class="col-sm-12 product_summery">
								<p class="align-center">Easy Polo Black Edition</p>
							</div>
							<div class="col-sm-12 add_to_cart align-center">
								<a href="#" class="btn btn-link"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add To Cart</a>
							</div>
						</div>
						
					</div>
				';
		echo json_encode($json_data);
	}