<?php
// Load the database configuration file
include_once 'dbConfig.php';

// Include PhpSpreadsheet library autoloader
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (isset($_POST['importSubmit'])) {

    // Allowed mime types
    $excelMimes = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // Validate whether selected file is an Excel file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            // Remove header row
            unset($worksheet_arr[0]);

            foreach ($worksheet_arr as $row) {
                $number = $db->real_escape_string($row[0]);
                $name = $db->real_escape_string($row[1]);
                $phone = $db->real_escape_string($row[2]);
                $address = $db->real_escape_string($row[3]);
                $province = $db->real_escape_string($row[4]);

                // Check whether member already exists in the database with the same number
                $prevQuery = "SELECT id FROM members WHERE number = '$number'";
                $prevResult = $db->query($prevQuery);

                if ($prevResult && $prevResult->num_rows > 0) {
                    // Update member data in the database
                    $db->query("UPDATE members SET name = '$name', phone = '$phone', address = '$address', province = '$province' WHERE number = '$number'");
                } else {
                    // Insert member data into the database
                    $db->query("INSERT INTO members (number, name, phone, address, province, chosen) VALUES ('$number', '$name', '$phone', '$address', '$province', 0)");
                }
            }
        } else {
        }
    } else {
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

exit();
