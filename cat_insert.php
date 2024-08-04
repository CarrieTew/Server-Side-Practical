<?php
include("auth.php");
require('database.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
 $category_name =$_REQUEST['category_name'];
 $category_desc = $_REQUEST['category_desc'];
 $date_record = date("Y-m-d H:i:s");
 $submittedby = $_SESSION["username"];
 $ins_query="INSERT into category
 (`category_name`,`category_desc`,`date_record`,`submittedby`)values
 ('$category_name','$category_desc','$date_record','$submittedby')"; 
 mysqli_query($con,$ins_query) or die(mysqli_error($con));
 $status = "New category Inserted Successfully.
 </br></br><a href='cat_view.php'>View Category Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Category</title>
</head>
<body>
<p><a href="dashboard.php">User Dashboard</a>
| <a href="view.php">View Category Records</a>
| <a href="logout.php">Logout</a></p>
<h1>Insert New Category</h1>
<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />
<p><input type="text" name="category_name" placeholder="Enter category Name"
required /></p>
<p><textarea name="category_desc" placeholder="Enter Category Description"cols="30" rows="10" require></textarea></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#008000;"><?php echo $status; ?></p>
</body>
</html>