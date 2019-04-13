<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

$con=mysqli_connect("localhost","root","","community");
if(isset($_POST['login_submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
$query="select*from logintb where username='$username' and password='$password' ";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==1)
{

	$_SESSION['login_user'] = $username;
	header("Location:control.php");
}
else
{
	echo "<script>alert('Enter correct details.')</script>";
	echo "<script>window.open('index.php','_self');</script>";
}
}
if(isset($_POST['signup_submit']))
{
	$new_username=$_POST['new_username'];
	$new_password=$_POST['new_password'];
	$query="insert into logintb(username,password)values('$new_username','$new_password')";
	$result=mysqli_query($con,$query);
	if($result)
	{
		echo "<script>alert('User Successfully added')</script>";
		echo "<script>window.open('index.php','_self');</script>";
	}
}
if(isset($_POST['item_submit']))
{	
	$email=$_POST['email'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		echo "<script>alert('Invalid email format')</script>";
		echo "<script>window.open('control.php','_self');</script>";
	}
	else
	{
	$uname=$_POST['u_name'];
	$name=$_POST['i_name'];
	$price=$_POST['i_price'];
	$quantity=$_POST['i_quantity'];
	$location=$_POST['i_location'];
	$deadline=$_POST['i_deadline'];
	$query="insert into req_item(username,email,name,price,quantity,location,deadline)values('$uname','$email','$name','$price','$quantity','$location','$deadline')";
	$result=mysqli_query($con,$query);
	if($result)
	{
		echo "<script>alert('Item Request added')</script>";
		echo "<script>window.open('control.php','_self');</script>";	
	}
	}
}
function get_uitems()
{
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
global $con;
$query="select * from req_item where username='$login_session'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
	$name=$row['name'];
	$price=$row['price'];
	$quantity=$row['quantity'];
	$location=$row['location'];
	$deadline=$row['deadline'];
	$deliverer=$row['deliverer'];
	if($deliverer<>'')
	{
		$status='On Delivery by '.$deliverer;
	}
	else
	{
		$status='Pending';
	}
	echo "<tr>
	<td>$name</td>
	<td>$price</td>
	<td>$quantity</td>
	<td>$location</td>
	<td>$deadline</td>
	<td>$status</td>
	</tr>";
}
}

function get_items()
{
	global $con;
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
$query="select * from req_item where deliverer=''and username<>'$login_session'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
	$name=$row['name'];
	$price=$row['price'];
	$quantity=$row['quantity'];
	$location=$row['location'];
	$deadline=$row['deadline'];
	echo "<tr>
	<td>$name</td>
	<td>$price</td>
	<td>$quantity</td>
	<td>$location</td>
	<td>$deadline</td>
	</tr>";
}
}
function accept_item()
{	

	global $con;
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
	$query="select * from req_item where deliverer=''and username<>'$login_session'";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{	
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
		
	}
	
}
if(isset($_POST['item_accept']))
{	
	include('config.php');
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
	$iname=$_POST['i_name'];
	$query="update req_item set deliverer='$login_session' where name='$iname'";
	$result=mysqli_query($con,$query);
	$query3="insert into credit (from_user, money, to_user) select username,price,deliverer from req_item where name='$iname'";
	$result3=mysqli_query($con,$query3);
	if($result3)
	{
		echo "<script>alert('Delivery Request accepted')</script>";
		echo "<script>window.open('control.php','_self');</script>";
		
	}	
}
function deliver_item()
{	

	global $con;
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
	$query="select * from req_item where deliverer ='$login_session'";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
	}
}
if(isset($_POST['item_deliver']))
{	
	include('config.php');
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
	$iname=$_POST['i_name'];
	$query="delete from req_item where name='$iname'";
	$result=mysqli_query($con,$query);
	if($result)
	{
		echo "<script>alert('Item Succssfully Delivered')</script>";
		echo "<script>window.open('control.php','_self');</script>";	
	}
}
function pay()
{
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
global $con;
$query="select * from credit where from_user='$login_session'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
	$from_user=$row['from_user'];
	$money=$row['money'];
	$to_user=$row['to_user'];
	echo "<tr>
	<td>$to_user</td>
	<td>$money</td>
	
	</tr>";
}
}
function recieve()
{
	include('config.php');
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($con,"select username from logintb where username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['username'];
global $con;
$query="select * from credit where to_user='$login_session'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
	$from_user=$row['from_user'];
	$money=$row['money'];
	$to_user=$row['to_user'];
	echo "<tr>
	<td>$from_user</td>
	<td>$money</td>
	</tr>";
}
}