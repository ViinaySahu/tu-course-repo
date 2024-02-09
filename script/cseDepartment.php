<?php

// Include your database connection code here
include('../config/database.php');

// Assuming your database connection class is DbConnect
$obj = new DbConnect();
$conn = $obj->conn;

// Fetch department data from the database
$query = "SELECT department_id, department_name FROM department";
$result = $conn->query($query);

if ($result) {
    $departments = array();

    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }

    // Close the database connection
    $obj->closeConnection();

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($departments);
} else {
    // Handle the error if the query fails
    echo json_encode(array('error' => 'Error fetching department data'));
}

?>
