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

if (isset($_POST['submit'])) {
    $pdfContent = file_get_contents($_FILES['pdf']['tmp_name']);
    $pdfContent = $conn->real_escape_string($pdfContent);

    $sql = "INSERT INTO pdf_table (pdf_data) VALUES ('$pdfContent')";
    
    if ($conn->query($sql) === TRUE) {
        echo "PDF uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="pdf">Choose PDF:</label>
        <input type="file" name="pdf" accept=".pdf">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>
