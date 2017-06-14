<div class="container-fluid">
	<div class="checkout">
		<div class="container">
			<div class="col-sm-12">
				<form id="checkout" action="" method="post">
					<div class="col-sm-4 billing_address">
						<div class="col-sm-12">
							<h3>Billing Address</h3>
						</div>
						<?php 
							if (!empty($data->user_info)) {
								
								$user = $data->user_info;
						?>

						<div class="col-sm-12 no-padding">
							
								<div class="col-sm-12">
									<input type="text" name="username" placeholder="User Name" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="fname" placeholder="First Name" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="lname" placeholder="Last Name" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="email" placeholder="Email" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="password" placeholder="Password" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="re-password" placeholder="Re enter password" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="address" placeholder="Address" value="<?php echo $user->city.' , '.$user->regionName.' , '.$user->country?>" class="form-control">
								</div>
								<div class="col-sm-12">
									<select class="form-control" id="country">
										<option class="form-control" value="<?=$user->countryCode?>"><?=$user->country?></option>
										<option class="form-control" value="IN">India</option>
										<option class="form-control" value="US">United States</option>
										<option class="form-control" value="UK">United Kingdom</option>
										<option class="form-control" value="FR">France</option>
										<option class="form-control" value="BD">Bangladesh</option>
									</select>
								</div>

								<div class="col-sm-12">
									<input type="text" name="city" placeholder="City" value="<?=$user->city?>" class="form-control">
								</div>

								<div class="col-sm-12">
									<input type="text" name="zip_code" placeholder="ZIP Code" value="<?=$user->zip?>" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="comphany_name" placeholder="Comphany Name" class="form-control">
								</div>
								<div class="col-sm-12">
									<input type="text" name="fax" placeholder="Fax No" class="form-control">
								</div>
								<div class="col-sm-12 shipt_me">
									<div class="col-sm-2">
										<input type="checkbox" name="shipt_me" class="form-control">
									</div>
									<div class="col-sm-10">
										<span>Shipt me same address</span>
									</div>
								</div>	
						</div>
						<?php
							}
						?>
					</div>
					<div class="col-sm-4 payment_method">
						<div class="col-sm-12">
							<h3>Payment Method</h3>
						</div>
						<div class="col-sm-12 no-padding">
							<div class="col-sm-12">
								<div class="col-sm-2">
									<input type="radio" name="paypal" class="form-control">
								</div>
								<div class="col-sm-10">
									<img src="/images/footer_mid/paypal.png" class="img-responsive">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="col-sm-2">
									<input type="radio" name="paypal" class="form-control" checked>
								</div>
								<div class="col-sm-10">
									<img src="/images/footer_mid/visa.png" class="img-responsive">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="col-sm-2">
									<input type="radio" name="paypal" class="form-control">
								</div>
								<div class="col-sm-10">
									<img src="/images/footer_mid/master_card.png" class="img-responsive">
								</div>
							</div>
						</div>
						<div class="col-sm-12 no-padding">
							<div class="col-sm-12">
								<input type="text" name="card_holder" placeholder="Name of Card Holder" class="form-control" id="card_holder">
							</div>
							<div class="col-sm-12">
								<input type="text" name="card_number" placeholder="Card Number" class="form-control" id="card_number">
							</div>
							<div class="col-sm-12">
								<input type="text" name="exipre_date" placeholder="Expiration Date" class="form-control" id="exipre_date">
							</div>
							<div class="col-sm-12">
								<input type="text" name="card_verification" placeholder="Card Verification Number" class="form-control" id="card_verification">
							</div>
						</div>
					</div>
					<div class="col-sm-4 review_order no-padding-right">
						<div class="col-sm-12">
							<h3>Review Your Order</h3>
						</div>
						<div class="col-sm-12 no-padding-right">
							<table border="3" id="review_table" style="border-color:#fff !important">
								<thead>
									<tr>
										<th>Product</th>
										<th>Qty</th>
										<th>SubTotal</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if (!empty($data->checkout)) {
										$i=1;
										foreach ($data->checkout as $checkout) {
								?>
								<tr class="display_product product_<?=$i?>">
									<td><?=$checkout->product_name?></td>
									<td>
										<input type="hidden" name="single_price" value="<?=$checkout->price?>" class="form-control" id="single_price<?=$i?>">
									</td>
									<td>
										<input type="text" id="qty_input<?=$i?>" name="qty" value="<?=$checkout->qty?>" class="form-control">
									</td>
									<td class="single_total<?=$i?>"><strong><?=$checkout->price?></strong></td>
									<td id="total_price<?=$i?>" class="single_total<?=$i?>"><input type="hidden" name="price" value="<?=$checkout->price?>" class="form-control"></td>
								</tr>
								<?php
									$i++;
										}
									}
								?>
									
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2">Grand Total</td>
										<td id="price_total" class="price_total"><strong>Tk. 0</strong></td>
									</tr>
								</tfoot>
							</table>
						</div>

						<div class="col-sm-12 order_now">
							<input type="submit" name="checkout" class="btn btn-success btn-lg" value="Order Now" id="submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>