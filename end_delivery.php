<?php 
error_reporting(E_ALL & ~E_NOTICE); include("function.php");
   include('session.php');
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:aliceblue;">
<div class="jumbotron" style="background:url('images/logo.png')no-repeat;background-position:center left;height:150px;;background-color:navy;"></div>
<div class="container-fluid">
<div class="row">
	<div class ="col-md-3">
		<div class="list-group">
			<a href="control.php" class="list-group-item active">Requesting a Delivery</a>
			<a href="control.php" class="list-group-item">Add Item</a>
			<a href="requested_item.php" class="list-group-item">Requested Items</a>
			<a href="payment.php" class="list-group-item">Payments Done</a>
		</div>
		<hr>
		<div class="list-group">
			<a href="" class="list-group-item active">Delivering a Request</a>
			<a href="available_items.php" class="list-group-item">Available Deliveries</a>
			<a href="accept_item.php" class="list-group-item">Accept Item</a>
			<a href="end_delivery.php" class="list-group-item">End Delivery</a>
			<a href="recieved.php" class="list-group-item">Payments Recieved</a>
		</div>
	</div>	
	<div class ="col-md-8">
	<div class="card-body" style="background-color:dodgerblue;color:#ffffff;">
	<h5> Ongoing Deliveries </h5>
			</div>
			<div class="card-body">
				<form class="form-group" action="function.php" method="post">
					<label>Item:</label>
					<select name="i_name" class="form-control" ><br>
					<?php deliver_item();?>
					</select><br>
					<input type ="submit" class="btn btn-primary" name="item_deliver" value="End Delivery">
				</form>
			</div>
			</div>
			</div>
			</div>
			</div>
</body>
</html>	