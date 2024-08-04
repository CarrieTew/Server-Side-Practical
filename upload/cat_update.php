<?php
include("auth.php");
require('database.php');
$id=$_REQUEST['id'];
$query = "SELECT * FROM category where id='".$id."'";
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Category Record</title>
</head>
<body>
<p><a href="dashboard.php">User Dashboard</a>
| <a href="insert.php">Insert New Product Category</a>
| <a href="logout.php">Logout</a></p>
<h1>Update Product Category Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$category_name =$_REQUEST['category_name'];
$category_desc =$_REQUEST['category_desc'];
$date_record = date("Y-m-d H:i:s");
$submittedby = $_SESSION["username"];
$update="UPDATE category set date_record='".$date_record."',
category_name='".$category_name."',category_desc='".$category_desc."',
submittedby='".$submittedby."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
$status = "Product Category Updated Successfully. </br></br>
<a href='cat_view.php'>View Updated Record</a>";
echo '<p style="color:#008000;">'.$status.'</p>';
}else {
?>
<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<p><input type="text" name="category_name" placeholder="Update Category Name"
required value="<?php echo $row['category_name'];?>" /></p>
<p><textarea name="category_desc" placeholder="Update Category Description"
required><?php echo $row['category_desc'];?></textarea></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</body>
</html>