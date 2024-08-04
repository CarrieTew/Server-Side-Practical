<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Product Records</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    #paginationControls {
        text-align: center;
    }

    #paginationControls button {
        font-size: 14px;
        margin: 5px;
        padding: 5px 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #paginationControls button:hover {
        background-color: #ddd;
    }
</style>
</head>
<body>
<?php if(!isset($_GET['action']) || ($_GET['action'] !== 'search')) { ?>
<h2>View - Product Records</h2>
<p><a href="dashboard.php">Back to User Dashboard</a></p><br>
<label>Search: <input type="text" id="search" placeholder="Live Search" onkeyup="liveSearch()"></label>
<div id="searchResults"></div>
<div id="pagination"></div>

<?php } ?>


<?php
require('database.php');
if(isset($_GET['action']) && $_GET['action'] === 'search') {
    $search = $_GET['search'];
    $product_name= $search;
    $price = $search;
    $quantity = $search;
    $date_record = $search;
    $submittedby = $search;

    $itemsPerPage = 3;

    
    $sqlCount = "SELECT COUNT(*) AS total FROM products WHERE product_name LIKE '%$product_name%' OR price LIKE '%$price%' OR quantity LIKE '%$quantity%' OR date_record LIKE '%$date_record%' OR submittedby LIKE '%$submittedby%'";
    $resultCount = mysqli_query($con, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalResults = $rowCount['total'];
    $totalPages = ceil($totalResults / $itemsPerPage);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $startIndex = ($page - 1) * $itemsPerPage;

    $sql = "SELECT * FROM products WHERE product_name LIKE '%$product_name%' OR price LIKE '%$price%' OR quantity LIKE '%$quantity%' OR date_record LIKE '%$date_record%' OR submittedby LIKE '%$submittedby%' LIMIT $startIndex, $itemsPerPage";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table width='100%' border='1' style='border-collapse:collapse;'>
        <thead>
        <tr>
        <th><strong>No.</strong></th>
        <th><strong>Product Name</strong></th>
        <th><strong>Product Price</strong></th>
        <th><strong>Quantity</strong></th>
        <th><strong>Date Record</strong></th>
        <th><strong>Submitted By</strong></th>
        </tr>
        </thead>
        <tbody>";

        $count = $startIndex + 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td align='center'>".$count."</td>
            <td align='center'>".$row["product_name"]."</td>
            <td align='center'>".$row["price"]."</td>
            <td align='center'>".$row["quantity"]."</td>
            <td align='center'>".$row["date_record"]."</td>
            <td align='center'>".$row["submittedby"]."</td>
            </tr>";
            $count++;
        }

        echo "</tbody>
        </table>";

        echo "<div id='paginationControls'>";
        if ($totalPages > 1) {
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<button onclick='fetchPage($i)'>$i</button>";
            }
        }
        echo "</div>";
    } else {
        echo "No results found";
    }
}
?>

<script>
function liveSearch() {
    var searchValue = $('#search').val();
    $.get('search_product.php', { action: 'search', search: searchValue }, function(response) {
        $('#searchResults').html(response);
    });
}

function fetchPage(pageNumber) {
    $.ajax({
        url: 'search_product.php',
        type: 'GET',
        data: { action: 'search', search: $('#search').val(), page: pageNumber },
        success: function(response) {
            $('#searchResults').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching page:', error);
        }
    });
}
</script>

</body>
</html>