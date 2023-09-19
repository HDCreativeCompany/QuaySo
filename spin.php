<?php
// Load the database configuration file
include_once 'dbConfig.php';

// Function to fetch a random record from the database
function getRandomRecord() {
    global $db;

    // Query to select a random record from members that hasn't been selected before
    $sql = "SELECT id, number, name FROM members WHERE chosen = 0 ORDER BY RAND() LIMIT 1";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Handle spinning
if (isset($_POST['spin'])) {
    // Get a random record
    $randomRecord = getRandomRecord();

    if ($randomRecord) {
        // Display the selected number and name
        $randomNumber = $randomRecord['number'];
        $randomName = $randomRecord['name'];

        // Mark the record as selected so it won't be spun again
        $db->query("INSERT INTO result (number,name) VALUES ('$randomNumber','$randomName')");
        $db->query("UPDATE members SET chosen = 1 WHERE id = " . $randomRecord['id']);
    } else {
        $statusMsg = '?status=nospin';
    }
    header("Location: index.php" . $statusMsg);
}
?>