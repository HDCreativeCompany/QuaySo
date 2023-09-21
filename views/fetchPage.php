<?php
include_once '../util/dbConfig.php';

// Pagination variables
$rowsPerPage = 20;  // Number of rows per page

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number
$startRow = ($page - 1) * $rowsPerPage; // Starting row for the current page
// Get total number of rows
$totalRowsQuery = $db->query("SELECT COUNT(*) AS total FROM members");
$totalRows = $totalRowsQuery->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRows / $rowsPerPage);

// Get member rows for the current page
$result = $db->query("SELECT * FROM members ORDER BY id ASC LIMIT $startRow, $rowsPerPage");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['province']; ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="6">No member(s) found...</td>
    </tr>
<?php } ?>
