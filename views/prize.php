<?php
include_once '../util/dbConfig.php';

// Pagination variables
$rowsPerPage = 20;  // Number of rows per page

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number
$startRow = ($page - 1) * $rowsPerPage; // Starting row for the current page

$totalRowsQuery = $db->query("SELECT COUNT(*) AS total FROM prize");
$totalRows = $totalRowsQuery->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRows / $rowsPerPage);
// Get prize rows for the current page
$result = $db->query("SELECT * FROM prize ORDER BY prizeid ASC LIMIT $startRow, $rowsPerPage");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prize Data</title>
    <!-- Add your CSS styling here -->
</head>

<body>
    <div class="container-xxl flex-grow-1 container-p-y">

        <h2>Prize Data</h2>
        <table class="table table-striped table-bordered table-sm ">
            <thead class="table-dark">
                <tr>
                    <th>Prize ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <?php
                if ($result->num_rows > 0) {
                    $i = $startRow + 1; // Start count from the correct index
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['prizeid']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">No prize(s) found...</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Pagination controls -->
    </div>
   

</body>

</html>
