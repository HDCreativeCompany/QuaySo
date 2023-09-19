<?php
// Load the database configuration file 
include_once 'dbConfig.php';

// Get status message 
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Member data has been imported successfully.';
            break;
        case 'clear_succ':
            $statusType = 'alert-success';
            $statusMsg = 'Data has been clear successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'clear_err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid Excel file.';
            break;
        case 'nothing':
            $statusType = 'alert-danger';
            $statusMsg = 'There is no data in database';
            break;
        case 'nospin':
            $statusType = 'alert-danger';
            $statusMsg = 'Out of stock any lucky spin';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Import Excel File Data with PHP</title>

    <!-- Bootstrap library -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Stylesheet file -->
    <link rel="stylesheet" href="assets/css/style.css">


    <!-- Show/hide Excel file upload form -->
    <script>
        function formToggle(ID) {
            var element = document.getElementById(ID);
            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>
</head>

<body>

    <div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import Excel</a>

            </div>
            <form action="spin.php" method="post">
                <button type="submit" name="spin" class="btn btn-primary">Spin</button>
            </form>
        </div>
        <!-- Excel file upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form class="row g-3" action="importData.php" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <label for="fileInput" class="visually-hidden">File</label>
                    <input type="file" class="form-control" name="file" id="fileInput" />
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                </div>
            </form>
        </div>

        <!-- Data list table -->
        <div class="col-md-12">
            <!-- Display status message -->
            <?php if (!empty($statusMsg)) { ?>
                <div class="col-xs-12 p-3">
                    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                </div>
            <?php } ?>

            <h2>Members Data</h2>
            <table class="table table-striped table-bordered table-sm">
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
                <tbody>
                    <?php
                    // Get member rows 
                    $result = $db->query("SELECT * FROM members ORDER BY id ASC");
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['province']; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="7">No member(s) found...</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="float-end"> 
            <!-- Button to clear data -->
            <form class="row g-3" action="clearData.php" method="post" enctype="multipart/form-data">
                <button type="submit" class="btn btn-danger" name="clearData">Clear Data</button>
            </form>
            </div>

        </div>

        <!-- Result table -->
        <div class="col-md-12">
            <h2>Results</h2>
            <table class="table table-striped table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Number</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get result rows 
                    $result = $db->query("SELECT * FROM result ORDER BY id ASC");
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3">No result(s) found...</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="float-end">  
            <form class="row g-3" action="clearData.php" method="post" enctype="multipart/form-data">
                <button type="submit" class="btn btn-danger" name="clearResult">Clear Result</button>
            </form>
            </div>
           


        </div>
    </div>

</body>

</html>