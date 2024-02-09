<?php
include('../config/database.php'); // Adjust the path based on your file structure

// Create a database connection
$obj = new DbConnect();
$conn = $obj->conn;

// Check if the connection is successful
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $courseCode = $_POST["course_code"];
    $courseName = $_POST["course_name"];
    $corequisite = $_POST["corequisite"];
    $lectureHours = $_POST["l"];
    $tutorialHours = $_POST["t"];
    $practicalHours = $_POST["p"];
    $abstract = $_POST["abstract"];
    $departmentId = $_POST["department_id"];

    // Insert data into the course table
    $sql = "INSERT INTO course (course_code, course_name, corequisite, l, t, p, abstract, department_id)
            VALUES ('$courseCode', '$courseName', '$corequisite', $lectureHours, $tutorialHours, $practicalHours, '$abstract', $departmentId)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
$obj->closeConnection();
?>
