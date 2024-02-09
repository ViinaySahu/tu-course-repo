<?php
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT pdf_data FROM pdf_table WHERE pdf_id = 1"; // Replace 1 with the desired PDF ID

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pdfContent = $row['pdf_data'];

    header("Content-type: application/pdf");
    echo $pdfContent;
} else {
    echo "PDF not found.";
}

$conn->close();
?>
