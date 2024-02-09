<?php
include('../config/database.php');

function insertCourseContents($syllabusId, $descriptions)
{
  $obj = new DbConnect();
  $conn = $obj->conn;

  foreach ($descriptions as $description) {
    $sql = "INSERT INTO course_contents (syllabus_id, description) VALUES ($syllabusId, '$description')";

    if ($conn->query($sql) !== TRUE) {
      // Handle the error
      echo "Error: " . $sql . "<br>" . $conn->error;
      $obj->closeConnection();
      return;
    }
  }

  echo "New records created successfully";
  $obj->closeConnection();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $syllabusId = $_POST["syllabus_id"];
  $descriptions = $_POST["description"];

  // Call the function to insert course contents
  insertCourseContents($syllabusId, $descriptions);
} else {
  echo "Invalid request method";
}
?>