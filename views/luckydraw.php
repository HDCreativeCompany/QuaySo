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
                'pname' => $row['pname']
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
    $phone = "";

    if ($randomRecord) {

        $randomNumberFromDatabase = $randomRecord['number'];
        $randomNumber = str_pad($randomNumberFromDatabase, 4, '0', STR_PAD_LEFT);  // Add leading zeros

        // Display the selected number, name, and prizeid

        $randomName = $randomRecord['name'];
        $phone = $randomRecord['phone'];

        // Mark the record as selected so it won't be spun again
        $db->query("INSERT INTO result (number, name, prizeid, phone) VALUES ('$randomNumber', '$randomName', '$type','$phone')");
        $db->query("UPDATE members SET chosen = 1 WHERE id = " . $randomRecord['id']);
    }

    // Prepare the response as an associative array
    $response = array(
        'randomNumber' => $randomNumber,
        'randomName' => $randomName,
        'phone' => $phone
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
            display: flex;
            justify-content: space-between;
            width: 100%;
            /* Adjust the width as needed */
            margin: 0 auto;
        }

        .drawcontainer {
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

        .left-section {
            width: 100%;
            /* Adjust the width as needed */
            padding: 20px;
            /* Background color for left section */
        }

            .right-section {
                width: 25%;
                height: 726px;
                /* Adjust the width as needed */
                padding: 10px;
                background-color: #FFF;
                text-align: center;
                /* Background color for right section */
            }

            .right-section-title {
                font-size: 30px;
            }

            .right-section-content {
                font-size: 25px;
                text-align: center;
            }

        /* Initially hide all result containers */
        .result-container {
            display: none;
        }

        /* Show the result container for the selected prizeId */
        .result-container.show {
            display: block;
        }

        .odometer {

            margin: 0 75px 0 55px;
            /* Margin for the odometer */
            font-size: 500px;
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

        #resultName {
            font-size: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section drawcontainer">
            <!--      <div id="resultName">Số may mắn</div> -->
            <odometer id="resultNum" class="odometer">0000</odometer>

            <div class="button-container row g-3">
                <select id="prizeSelect" class="form-control col-md-6" style="text-align: center;">
                    <?php
                    foreach ($prizes as $prize) {
                        echo '<option value="' . $prize['prizeid'] . '">' . $prize['pname'] . '</option>';
                    }
                    ?>
                </select>

                <button id="claimPrizeBtn" class="btn btn-primary">Quay Số</button>
            </div>
        </div>

        <div class="right-section">
            <div class="right-section-title" id="right-section-title">SỐ TRÚNG GIẢI</div>
            <div class="right-section-content" id="right-section-content"></div>
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

            /*  document.getElementById('resultName').innerText = "Số may mắn"; */
            document.getElementById('resultNum').innerText = '0000';
            var selectedPrizeId = document.getElementById('prizeSelect').value;

            // Make an AJAX request to a PHP script to call the draw function
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'luckydraw.php?selectedPrizeId=' + selectedPrizeId, true);

            xhr.onload = function() {
                if (xhr.status === 200) {

                    // Parse the response JSON if needed (assuming it's JSON)
                    var response = JSON.parse(xhr.responseText);

                    // Update the HTML element with the random number and name
                    var odometerElement = document.getElementById('resultNum');
                    var odometer = new Odometer({
                        minIntegerLen: 4,
                        el: odometerElement,
                        duration: 2000,
                        format: 'd',
                        theme: 'default',
                        animation: 'count'
                    });

                    // Định dạng response.randomNumber thành 4 chữ số
                    var formattedNumber = formatNumberToFourDigits(response.randomNumber);
                    odometer.update(formattedNumber);
                    setTimeout(function() {
                        // Assuming you have an element with the id 'resultName' to display the name
                        /*   document.getElementById('resultName').innerText = response.randomName; */
                        updateRightSection(selectedPrizeId);
                    }, 2000);

                } else {
                    alert('Failed to claim the prize. Please try again.');
                }
            };

            xhr.send();

        });
        // Function to update the right-section with data based on the selected prizeid
        // Function to update the right-section with data based on the selected prizeid
        function updateRightSection(prizeId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_results.php?prizeId=' + prizeId, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    // Get the right-section-content element
                    var rightSectionContent = document.getElementById('right-section-content');

                    if (rightSectionContent) {
                        rightSectionContent.innerHTML = ''; // Clear previous content

                        // Display the results in the right-section
                        for (var i = 0; i < response.length; i++) {
                            var result = response[i];
                            var resultItem = document.createElement('div');
                            resultItem.style.border = '1px solid #7367f0';
                            resultItem.style.margin = '5px';
                            resultItem.style.textAlign = 'center';
                            resultItem.innerText = result.number;
                            rightSectionContent.appendChild(resultItem);
                        }

                        if (rightSectionContent.childElementCount >= 15) {
                            rightSectionContent.style.flexDirection = "column"; // Chuyển về hiển thị theo chiều dọc
                        }
                    }
                } else {
                    alert('Failed to fetch data. Please try again.');
                }
            };

            xhr.send();
        }

        // Event listener for when the prizeSelect value changes
        document.getElementById('prizeSelect').addEventListener('change', function() {
            var selectedPrizeId = this.value;
            updateRightSection(selectedPrizeId);
        });

        window.onload = function() {
            // Your code to be executed after the window is fully loaded
            // For example, you can call your updateRightSection function here
            var selectedPrizeId = document.getElementById('prizeSelect').value;
            updateRightSection(selectedPrizeId);
        };
    </script>

</body>