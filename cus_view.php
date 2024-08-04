<?php
include("auth.php");
require('database.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Customer Records</title>
</head>
<body>
<p><a href="index.php">Home Page</a></p>
| <a href="cus_insert.php">Insert New Customer</a>
| <a href="logout.php">Logout</a></p>
<h2>View Product Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>No.</strong></th>
<th><strong>Customer First Name</strong></th>
<th><strong>Customer Last Name</strong></th>
<th><strong>Address</strong></th>
<th><strong>Phone Number</strong></th>
<th><strong>Email</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="SELECT * FROM customer ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["cus_first"]; ?></td>
<td align="center"><?php echo $row["cus_last"]; ?></td>
<td align="center"><?php echo $row["address"]; ?></td>
<td align="center"><?php echo $row["phone_num"]; ?></td>
<td align="center"><?php echo $row["email"]; ?></td>
<td align="center">
<a href="cus_update.php?id=<?php echo $row["id"]; ?>">Update</a>
</td>
<td align="center">
<a href="cus_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this customer record?')">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</body>
</html>