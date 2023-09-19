<?php
include_once '../util/dbConfig.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="col-md-12" id="importFrm">
        <form class="row g-3" action="../util/importData.php" method="post" enctype="multipart/form-data">
            <div class="col-auto">
                <label for="fileInput" class="visually-hidden">File</label>
                <input type="file" class="form-control" name="file" id="fileInput" />
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
            </div>

            <form class="col-auto" action="clearData.php" method="post" enctype="multipart/form-data">
                <button type="submit" class="btn btn-danger" name="clearData">Clear Data</button>
            </form>

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
</div>