<?php   include('session.php'); 
		include('function.php');
 ?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:aliceblue;">
<div class="jumbotron" style="background:url('images/logo.png')no-repeat;background-position:left;height:150px;;background-color:navy;"></div>
<h1>Welcome <?php echo $login_session; ?><span style="opacity:0;">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span><a href = "logout.php">Sign Out</a></h1> 
<hr>
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
		<div class="card">
			<div class="card-body" style="background-color:dodgerblue;color:#ffffff;">
			<h5> Enter Item Details </h5>
			</div>
			<div class="card-body">
				<form class="form-group" action="function.php" method="post">
					<label>User :</label>
					<input type="text" name="u_name" class="form-control" value='<?php echo $login_session?>' readonly><br>
					<label>Email :</label>
					<input type="text" name="email" class="form-control" required><br>
					<label>Item :</label>
					<input type="text" name="i_name" class="form-control" required><br>
					<label>Estimated Price :</label>
					<input type="number" name="i_price" class="form-control" required aria-describedby="passwordHelpBlock">	
					<small id="passwordHelpBlock" class="form-text text-muted">
						Cost of item is paid in advance
					</small><br>				
					<label>Quantity :</label>
					<input type="number" name="i_quantity" class="form-control" required><br>
					<label>Location :</label>
					<input type="text" name="i_location" class="form-control"><br>
					<label>Deadline :</label>
					<input type="date" name="i_deadline" class="form-control"required><br>
					<input type ="submit" class="btn btn-primary" name="item_submit" value="Enter Item">
				</form>
			</div>
		</div>
	</div>
	<div class ="col-md-1"></div>
</div>
</div>

















<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>