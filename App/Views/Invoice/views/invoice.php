<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	<style type="text/css">
		*{
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			outline: 0;
		}

		.container{
			width: 1024px;
			margin: 0px auto;
			position: relative;
		}

		.container::after{
			content: '';
			display: block;
			clear: both;
		}
		.invoice-title{
			padding: 80px 15px 0px 15px;
		}
		.invoice-id{
			color: #363636;
			padding-bottom: 30px;
			border-bottom: 2px solid #e3e3e3;
		}

		.invoice-item{
			padding: 0px 15px;
			width: 50%;
			float: left;
			margin-top: 30px;
		}
		.invoice-content{
			padding: 15px;
		}
		.payment-info,
		.instructor-info{
			border: 1px solid #e3e3e3;
			height: 80px;
		}
		.supplier-info,
		.customer-info{
			background-color: #ECECEC;
			border : 1px solid #ECECEC;
		}
		.invoice-content-title{
			color: #226622 !important;
			padding-bottom: 15px;
		}
		.invoice-content-item{
			font-size: 17px;
    		margin-bottom: 8px;
    		font-family: 'Roboto', sans-serif;
    		font-weight: 400;
    		color: #363636;
		}
		.invoice-content-item span{
			display: inline-block;
			width: 120px;
		}

		.invoice-list{
			width: 100%;
			display: block;
			padding-top: 30px;
			clear: both;
			box-sizing: border-box;
			position: relative;
		}
		.invoice-list::before{
			content: "";
			display: block;
			clear: both;
		}
		.table{
			width: 100%;
			border: 1px solid #e3e3e3;
		}
		.table tr th,
		.table tr td{
			padding: 10px;
			vertical-align: middle;
			border-bottom: 1px solid #e3e3e3;
			text-align: left;
		}
		.table tr:last-child td{
			border-bottom: 0px;
		}
		.total h2{
			margin-top: 30px;
			text-align: right;
			color: #363636;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<div class="invoice-title">
			<h1 class="invoice-id">Invoice ID #<?=$data['id']?></h1>
		</div>
		<div class="invoice-item">
			<div class="invoice-content payment-info">
				<p class="invoice-content-item"><span>Issued date:</span> <?=date('M d , Y',strtotime($data['date']))?></p>
				<p class="invoice-content-item"><span>Payment Term:</span> 15 days</p>
			</div>
		</div>
		<div class="invoice-item">
			<div class="invoice-content instructor-info">
				<p class="invoice-content-item"><span>Instructions:</span> Billing Details Information</p>
			</div>
		</div>
		<div class="invoice-item">
			<div class="invoice-content supplier-info">
				<h2 class="invoice-content-title">Supplier</h2>
				<p class="invoice-content-item"><span>Name:</span> <?=$data['supplierName']?></p>
				<p class="invoice-content-item"><span>Reg. No:</span> <?=$data['supplierRegNo']?></p>
				<p class="invoice-content-item"><span>Vat No:</span> <?=$data['suppilerVatNo']?></p>
				<p class="invoice-content-item"><span>Details:</span> <?=$data['supplierDetails']?></p>
			</div>
		</div>
		<div class="invoice-item">
			<div class="invoice-content customer-info">
				<h2 class="invoice-content-title">Customer</h2>
				<?php if(!empty($data['customerName'])):?>
				<p class="invoice-content-item"><span>Name:</span> <?=$data['customerName']?></p>
			<?php else:?>
				<p class="invoice-content-item"><span>Name:</span> <?=$data['customerEmail']?></p>
			<?php endif;?>
				<p class="invoice-content-item"><span>Reg. No:</span> <?=$data['customerRegNo']?></p>
				<p class="invoice-content-item"><span>Vat No:</span> <?=$data['customerVatNo']?></p>
				<p class="invoice-content-item"><span>Details:</span> <?=$data['customerDetails']?></p>
			</div>
		</div>
		<div class="invoice-list">
			<table class="table">
			    <thead>
			        <tr>  
			            <th>Item</th>           
			            <th>Quantity</th>
			            <th>Unit Price</th>
			            <th>Sub total</th>
			            <th>Currency</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			            <td><?=$data['product_title'];?></td>
			            <td><?=$data['qty']?></td>
			            <td><?=$data['price']?></td>
			            <td><?= $data['qty']*$data['price']?></td>
			            <td>Tk</td>
			        </tr>
			    </tbody>
			</table>
		</div>
		<div class="total">
			<h2>Total: <?= $data['qty']*$data['price']?> Taka Only</h2>
		</div>
	</div>
</body>
</html>