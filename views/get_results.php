<?php
include_once '../util/dbConfig.php';

if (isset($_GET['prizeId'])) {
    $prizeId = $_GET['prizeId'];

    // Fetch the results based on the selected prizeid
    $sql = "SELECT * FROM result WHERE prizeid = $prizeId";
    $result = $db->query($sql);

    $results = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = array('number' => $row['number']);
        }
    }

    // Return the results as JSON
    header('Content-Type: application/json');
    echo json_encode($results);
}
?>
