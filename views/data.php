<?php
include_once '../util/dbConfig.php';

// Pagination variables
$rowsPerPage = 20;  // Number of rows per page

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number
$startRow = ($page - 1) * $rowsPerPage; // Starting row for the current page

$totalRowsQuery = $db->query("SELECT COUNT(*) AS total FROM members");
$totalRows = $totalRowsQuery->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalRows / $rowsPerPage);
// Get member rows for the current page
$result = $db->query("SELECT * FROM members ORDER BY id ASC LIMIT $startRow, $rowsPerPage");
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row g-3" id="importFrm">

        <form class="col-md-6" action="../util/importData.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="fileInput" class="visually-hidden">File</label>
                <input type="file" class="form-control" name="file" id="fileInput" />

                <button class="btn btn-outline-primary" name="importSubmit" type="submit" id="importSubmit">Import</button>
            </div>
        </form>

        <form class="col-md-6" id="clearForm" action="../util/clearData.php" method="post" enctype="multipart/form-data">
            <div class="col-auto">
                <button type="button" class="btn btn-danger" onclick="loadingContent('clearData')">Clear Data</button>
            </div>
        </form>
        <div id="noti"></div>
    </div>

    <h2>Members Data</h2>
    <table class="table table-striped table-bordered table-sm ">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Province</th>
            </tr>
        </thead>
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
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['province']; ?></td>
                    </tr>
                <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">No member(s) found...</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Pagination controls -->
</div>
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            for ($pageNum = 1; $pageNum <= $totalPages; $pageNum++) {
                $activeClass = $pageNum === $page ? 'active' : '';
            ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $pageNum; ?>)"><?php echo $pageNum; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>
