<?php
include("auth.php");
require('database.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
 $cus_first =$_REQUEST['cus_first'];
 $cus_last =$_REQUEST['cus_last'];
 $address = $_REQUEST['address'];
 $phone_num = $_REQUEST['quantity'];
 $email = $_REQUEST['email'];
 $ins_query="INSERT into customer
 (`cus_first`,`cus_last`,`address`,`email`)values
 ('$cus_first','$cus_last','$address','$email')";
 mysqli_query($con,$ins_query)
 or die(mysqli_error($con));
 $status = "New Customer Inserted Successfully.
 </br></br><a href='cus_view.php'>View Customer Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Customer</title>
</head>
<body>
<p><a href="dashboard.php">User Dashboard</a>
| <a href="cus_view.php">View Customer Records</a>
| <a href="logout.php">Logout</a></p>
<h1>Insert New Customer</h1>
<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />
<p><input type="text" name="cus_first" placeholder="Enter Customer First Name"
required /></p>
<p><input type="text" name="cus_last" placeholder="Enter Customer Last Name"
required /></p>
<p><input type="tel" name="phone_num"  placeholder="Enter Phone Number" pattern="(\d{10}|\d{9})" required /></p>
<p><textarea name="address" placeholder="Enter Customer Address"cols="30" rows="10" required></textarea></p>
<p><input type="email" name="email" placeholder="Enter Customer Email" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#008000;"><?php echo $status; ?></p>
</body>
</html>