<?php
// Include your database connection script here
include('../config/database.php');
$obj = new DbConnect();
$conn = $obj->conn;

if (isset($_GET['schoolId'])) {
  $schoolId = $_GET['schoolId'];

  $query = "SELECT department_id, department_name FROM department WHERE school_id = ?";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $schoolId);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $departments = $result->fetch_all(MYSQLI_ASSOC);
      echo "<option value=''>Select Department</option>";
      foreach ($departments as $department) {
        echo "<option value='{$department['department_id']}'>{$department['department_name']}</option>";
      }
    } else {
      // Handle the error
      echo "Error executing query: " . $stmt->error;
    }
  } else {
    // Handle the error
    echo "Error preparing statement: " . $conn->error;
  }
}

$obj->closeConnection();
?>