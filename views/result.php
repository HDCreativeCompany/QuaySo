<?php
include_once '../util/dbConfig.php';

// Pagination variables
$rowsPerPage = 20;  // Number of rows per page

// Current page number
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Starting row for the current page
$startRow = ($page - 1) * $rowsPerPage;

// Get the prizeid for filtering
$prizeid = isset($_GET['prizeid']) ? $_GET['prizeid'] : '';

// Build the SQL query with filtering
$sql = "SELECT result.*, prize.pname AS prize_name FROM result LEFT JOIN prize ON result.prizeid = prize.prizeid";


if (!empty($prizeid)) {
    $sql .= " WHERE result.prizeid = '$prizeid'";
}
$sql .= " ORDER BY result.id ASC LIMIT $startRow, $rowsPerPage";

// Fetch total rows
$totalRowsQuery = $db->query("SELECT COUNT(*) AS total FROM result");
$totalRows = $totalRowsQuery->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRows / $rowsPerPage);

// Fetch member rows for the current page
$result = $db->query($sql);
?>

<body>
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Import and clear forms -->
        <div class="row g-3" id="importFrm">
            <!-- Add this button within the "Import and clear forms" section -->
            <button type="button" class="btn btn-primary" onclick="exportData()">Export Data</button>

            <form class="col-md-6" id="clearForm" action="../util/clearResult.php" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <button type="button" class="btn btn-danger" onclick="loadingContent('clearResult')">Clear Result</button>
                </div>
            </form>
            <div id="noti"></div>
        </div>


        <!-- Filter form for prizeid -->
        <div class="row g-3" id="importFrm">
            <form class="col-md-6" action="" method="GET">
                <label for="prizeid">Filter by Prize ID:</label>
                <input type="text" name="prizeid" id="prizeid" value="<?php echo $prizeid; ?>">
                <button type="submit">Filter</button>
            </form>
        </div>

        <h2>Members Data</h2>
        <table class="table table-striped table-bordered table-sm">
            <!-- Table header -->
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Prize</th> <!-- Added Prize ID column -->
                </tr>
            </thead>
            <!-- Table body -->
            <tbody id="dataTable">
                <?php
                if ($result->num_rows > 0) {
                    $i = $startRow + 1; // Start count from the correct index
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['number']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['prize_name']; ?></td> <!-- Display Prize Name -->
                        </tr>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">No member(s) found...</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Pagination controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                for ($pageNum = 1; $pageNum <= $totalPages; $pageNum++) {
                    $activeClass = $pageNum === $page ? 'active' : '';
                ?>
                    <li class="page-item <?php echo $activeClass; ?>">
                        <a class="page-link" href="javascript:void(0)" onclick="loadResult(<?php echo $pageNum; ?>)"> <?php echo $pageNum; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script src="script.js"></script> <!-- Add your JavaScript code here -->
</body>