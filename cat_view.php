<?php
include("auth.php");
require('database.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Product Category Records</title>
</head>
<body>
<p><a href="index.php">Home Page</a></p>
| <a href="cat_insert.php">Insert New Product Category</a>
| <a href="logout.php">Logout</a></p>
<h2>View Product Category Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>No.</strong></th>
<th><strong>Category Name</strong></th>
<th><strong>Category Description</strong></th>
<th><strong>Date and Time Recorded</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="SELECT * FROM category ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["category_name"]; ?></td>
<td align="center"><?php echo $row["category_desc"]; ?></td>
<td align="center"><?php echo $row["date_record"]; ?></td>
<td align="center">
<a href="cat_update.php?id=<?php echo $row["id"]; ?>">Update</a>
</td>
<td align="center">
<a href="cat_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this product record?')">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</body>
</html>