<?php
include_once '../util/dbConfig.php';
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
                <button type="button" class="btn btn-danger" onclick="clearData()">Clear Data</button>
            </div>
        </form>
    </div>

    <h2>Members Data</h2>
    <table class="table table-striped table-bordered table-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Prize</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // Get member rows 
            $result = $db->query("SELECT * FROM result ORDER BY id ASC LIMIT 20");
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
                        <td><?php echo $row['prize']; ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7">No member(s) found...</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>