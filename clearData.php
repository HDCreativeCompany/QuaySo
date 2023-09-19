<?php
// Load the database configuration file
include_once 'dbConfig.php';

if (isset($_POST['clearData'])) {
    
    // Query to clear all data from the 'members' table
    $clearQuery = "TRUNCATE TABLE members";
    
    if ($db->query($clearQuery)) {
        $statusMsg = '?status=clearsucc';
    } else {
        $statusMsg = '?status=clearerr';
    }
}
if (isset($_POST['clearResult'])) {
    // Query to clear all data from the 'result' table
    $prevQuery = "SELECT id FROM members WHERE number = '$number'";

    $clearQuery = "TRUNCATE TABLE result";
    $updateChosen = "UPDATE members SET chosen = 0 WHERE chosen = 1";
    if ($db->query($prevQuery))
        if ($db->query($clearQuery) && $db->query($updateChosen) ) {
            $statusMsg = '?status=clear_succ';
        } else {
            $statusMsg = '?status=clear_err';
        }
    else {
        $statusMsg = '?status=nothing';
    }
}

// Redirect back to index.php with a status message
header("Location: index.php" . $statusMsg);
