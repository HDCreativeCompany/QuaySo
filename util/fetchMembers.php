
<?php
include_once 'dbConfig.php';

$results_per_page = 10; // Number of results per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $results_per_page;

// Fetch members data with pagination
$result = $db->query("SELECT * FROM members ORDER BY id ASC LIMIT $offset, $results_per_page");

$data = array();
$tableContent = '';

while ($row = $result->fetch_assoc()) {
    $tableContent .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['number']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['province']}</td>
                    </tr>";
}

$total_rows = $result->num_rows; // Total number of rows
$total_pages = ceil($total_rows / $results_per_page); // Calculate total pages

$paginationLinks = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $paginationLinks .= "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link'>$i</a></li>";
}

$response = array('tableContent' => $tableContent, 'paginationLinks' => $paginationLinks);

echo json_encode($response);
?>
