<?php

// Include your database connection code here
include('../config/database.php');

// Assuming your database connection class is DbConnect
$obj = new DbConnect();
$conn = $obj->conn;

// Fetch course data from the database
$query = "SELECT course_id, course_name FROM course";
$result = $conn->query($query);

if ($result) {
    $courses = array();

    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    // Close the database connection
    $obj->closeConnection();

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($courses);
} else {
    // Handle the error if the query fails
    echo json_encode(array('error' => 'Error fetching course data'));
}

?>
