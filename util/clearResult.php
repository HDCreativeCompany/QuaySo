<?php
include_once '../util/dbConfig.php';

// Assuming 'result' is the table you want to clear
$tableName = 'result';

// SQL query to truncate (clear) the table
$sql = "TRUNCATE TABLE $tableName";

if ($db->query($sql) === TRUE) {
    echo "Table $tableName has been cleared successfully.";
} else {
    echo "Error clearing table: " . $db->error;
}

// Close the database connection
$db->close();
