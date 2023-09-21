<?php
include_once '../util/dbConfig.php';

// Assuming 'members' is the table you want to clear
$tableName = 'members';

// SQL query to truncate (clear) the table
$sql = "TRUNCATE TABLE $tableName";

if ($db->query($sql) === TRUE) {
    echo "Table $tableName has been cleared successfully.";
} else {
    echo "Error clearing table: " . $db->error;
}

// Close the database connection
$db->close();
