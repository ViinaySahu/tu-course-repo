<?php

include('../config/database.php');
$obj = new DbConnect();
$conn = $obj->conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $versionNumber = $_POST["version_number"];
  $effectiveDate = $_POST["effective_date"];
  $approvedBy = $_POST["approved_by"];
  $approvalNum = $_POST["approval_num"];
  $courseId = $_POST["course_id"];

  $sql = "INSERT INTO syllabus (version_number, effective_date, approved_by, approval_num, course_id)
          VALUES ($versionNumber, '$effectiveDate', '$approvedBy', '$approvalNum', $courseId)";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$obj->closeConnection();
?>