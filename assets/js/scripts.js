
function goToLink(text) {
    switch (text) {
        case 'spin':
            window.location.href = 'views/luckydraw.php';
            break;
        case 'setting':
            window.location.href = 'views/dashboard.php';
            break;
        default:
            // Handle the default case if needed
            break;
    }
}

function loadContent(text) {
    // Make an AJAX request to the PHP file
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Update the content in the dynamic-content div
                document.querySelector('#dynamic-content').innerHTML = xhr.responseText;
            } else {
                console.error('Error loading content:', xhr.status);
            }
        }
    };
    xhr.open('GET', text + '.php', true);
    xhr.send();
}

function loadData(pageNum) {
    // You'll need to make an AJAX request to fetch the data for the selected page
    // and update the table accordingly without refreshing the entire page.
    // Here's a basic example of how you might implement the AJAX request:
    // You may need to adjust this based on your application's requirements.

    // Make an AJAX request to fetch data for the selected page
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./fetchPage.php?page=" + pageNum, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Update the table with the fetched data
            document.getElementById("dataTable").innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}
function loadResult(pageNum) {
    // You'll need to make an AJAX request to fetch the data for the selected page
    // and update the table accordingly without refreshing the entire page.
    // Here's a basic example of how you might implement the AJAX request:
    // You may need to adjust this based on your application's requirements.

    // Make an AJAX request to fetch data for the selected page
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./fetchResult.php?page=" + pageNum, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Update the table with the fetched data
            document.getElementById("dataTable").innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}

function importData() {
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];

    var formData = new FormData();
    formData.append('file', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../util/importData.php', true);
    console.log(fileInput)
    console.log(file)

    xhr.onload = function () {
        if (xhr.status === 200) {

            console.log('Import successful');
        } else {
            console.error('Import failed. Status:', xhr.status);
        }
    };

    xhr.send(formData);
}

function loadingContent(text) {
    // You can add any logic here to clear the data as needed.
    // This is a simple example, assuming you want to confirm before clearing.
    switch (text) {
        case 'importData':
            loadContent('data');
            break;
        case 'clearData':
            if (confirm("Are you sure?")) {
                // Redirect to the clearData.php script to clear data
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("noti").innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", "../util/" + text + ".php", true);
                xhr.send();
                loadContent('data');
            }
            break
        case 'clearResult':
            if (confirm("Are you sure?")) {
                // Redirect to the clearData.php script to clear data
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("noti").innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", "../util/" + text + ".php", true);
                xhr.send();
                loadContent('data');
            }
            break
        default:
            break;
    }
    // Display a confirmation dialog

}

function exportData() {
    // Create a CSV content string with UTF-8 encoding
    let csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "\uFEFF"; // Byte Order Mark (BOM) to indicate UTF-8 encoding
    csvContent += "ID,Number,Name,Phone,Prize ID\n"; // CSV header

    // Iterate over the table rows and append data to the CSV content
    const tableRows = document.querySelectorAll("#dataTable tr");
    tableRows.forEach(row => {
        const columns = row.querySelectorAll("td");
        if (columns.length === 5) { // Ensure there are 5 columns (including Prize ID)
            const rowData = Array.from(columns).map(col => col.innerText);
            csvContent += rowData.join(",") + "\n";
        }
    });

    // Create a download link and trigger the download
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "ketquaquayso.csv");
    document.body.appendChild(link); // Required for Firefox
    link.click(); // Trigger the download
}
