<?php
include("auth.php");
require('database.php');
$id=$_REQUEST['id'];
$query = "SELECT * FROM customer where id='".$id."'";
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Customer Record</title>
</head>
<body>
<p><a href="dashboard.php">User Dashboard</a>
| <a href="cus_insert.php">Insert New Customer</a>
| <a href="logout.php">Logout</a></p>
<h1>Update Customer Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$cus_first =$_REQUEST['cus_first'];
$cus_last =$_REQUEST['cus_last'];
$address = $_REQUEST['address'];
$phone_num = $_REQUEST['phone_num'];
$email = $_REQUEST['email'];
$update="UPDATE customer set cus_first='".$cus_first."',
cus_last='".$cus_last."', address='".$address."', phone_num='".$phone_num."',
email='".$email."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
$status = "Customer Record Updated Successfully. </br></br>
<a href='cus_view.php'>View Updated Record</a>";
echo '<p style="color:#008000;">'.$status.'</p>';
}else {
?>
<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<p><input type="text" name="cus_first" placeholder="Update Customer First Name"
required value="<?php echo $row['cus_first'];?>" /></p>
<p><input type="text" name="cus_last" placeholder="Update Customer Last Name"
required value="<?php echo $row['cus_last'];?>" /></p>
<p><textarea name="address" placeholder="Update Customer Address" required><?php echo $row['address']; ?></textarea></p>
<p><input type="tel" name="phone_num" placeholder="Update Phone Number"
required pattern="(\d{10}|\d{9})" value="<?php echo $row['phone_num'];?>" /></p>
<p><input type="email" name="email" placeholder="Update Customer Email"
required value="<?php echo $row['email'];?>" /></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</body>
</html>