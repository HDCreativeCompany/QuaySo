<?php
include_once '../util/dbConfig.php';

// Assuming you have a function to retrieve prizes from the database
function getPrizesFromDatabase($db)
{
    $prizes = array();

    // Replace this with your own SQL query to fetch prizes from the database
    $result = $db->query("SELECT * FROM prize");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prizes[] = array(
                'prizeid' => $row['prizeid'],
                'name' => $row['name']
            );
        }
    }

    return $prizes;
}

function getRandomRecord($db)
{
    // Query to select a random record from members that hasn't been selected before
    $sql = "SELECT id, number, name, phone FROM members WHERE chosen = 0 ORDER BY RAND() LIMIT 1";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function draw($db, $type)
{
    // Get a random record
    $randomRecord = getRandomRecord($db);
    $randomNumber = "";
    $randomName = "";

    if ($randomRecord) {
        // Display the selected number, name, and prizeid
        $randomNumber = $randomRecord['number'];
        $randomName = $randomRecord['name'];
        $phone = $randomRecord['phone'];

        // Mark the record as selected so it won't be spun again
        $db->query("INSERT INTO result (number, name, prizeid, phone) VALUES ('$randomNumber', '$randomName', '$type','$phone')");
        $db->query("UPDATE members SET chosen = 1 WHERE id = " . $randomRecord['id']);
    }

    // Prepare the response as an associative array
    $response = array(
        'randomNumber' => $randomNumber,
        'randomName' => $randomName
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_GET['selectedPrizeId'])) {
    $selectedPrizeId = $_GET['selectedPrizeId'];
    draw($db, $selectedPrizeId);
    exit();  // Stop further execution
}

// Assuming $db is defined in dbConfig.php
$prizes = getPrizesFromDatabase($db);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odometer Example</title>

    <?php include 'static/head.php'; ?>
    <script src="../vendor/odometer/odometer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.css" />


    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Use min-height instead of height for responsiveness */
            margin: 0;
            background-color: #f0f0f0;
            /* Background color */
        }

        .container {
            /* Add your background image styles if needed */
            background-size: cover;
            width: 1150px;
            /* Width of the container */
            height: 600px;
            /* Height of the container */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            /* Align items in a column */
        }

        .odometer {

            margin: 0 75px 0 55px;
            /* Margin for the odometer */
            font-size: 200px;
            /* Font size of the odometer */
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            /* Adjust the margin to move the button down */
        }

        .button-container .btn {
            /* Add any additional styling you want for the button */
        }
    </style>
</head>

<body>
    <div class="container">
        <odometer id="resultNum" class="odometer">0000</odometer>
        <div id="resultName"></div>
        <div class="button-container row g-3">
            <select id="prizeSelect" class="form-control col-md-6" style="text-align: center;">
                <?php
                foreach ($prizes as $prize) {
                    echo '<option value="' . $prize['prizeid'] . '">' . $prize['name'] . '</option>';
                }
                ?>
            </select>

            <button id="claimPrizeBtn" class="btn btn-primary">Quay Số</button>
        </div>
    </div>

    <script>
        // Thêm hàm định dạng số thành 4 chữ số
        function formatNumberToFourDigits(num) {
            var formattedNumber = String(num);
            while (formattedNumber.length < 4) {
                formattedNumber = '0' + formattedNumber;
            }
            return formattedNumber;
        }

        // JavaScript code for button click event
        document.getElementById('claimPrizeBtn').addEventListener('click', function() {
            var selectedPrizeId = document.getElementById('prizeSelect').value;

            // Make an AJAX request to a PHP script to call the draw function
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'luckydraw.php?selectedPrizeId=' + selectedPrizeId, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    // Parse the response JSON if needed (assuming it's JSON)
                    var response = JSON.parse(xhr.responseText);

                    // Update the HTML element with the random number and name
                    var odometerElement = document.getElementById('resultNum');
                    var odometer = new Odometer({
                        el: odometerElement,
                        duration: 2000,
                        format: 'd',
                        theme: 'default',
                        animation: 'count'
                    });

                    // Định dạng response.randomNumber thành 4 chữ số
                    var formattedNumber = formatNumberToFourDigits(response.randomNumber);
                    odometer.update(formattedNumber);

                    // Assuming you have an element with the id 'resultName' to display the name
                    document.getElementById('resultName').innerText = response.randomName;
                } else {
                    alert('Failed to claim the prize. Please try again.');
                }
            };

            xhr.send();
        });
    </script>

</body>