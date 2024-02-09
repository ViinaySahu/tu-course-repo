<?php

// Include your database connection logic
include('../config/database.php');

// Assuming you have a function to insert textbooks
function insertTextbooks($syllabusId, $tbNames, $tbAuthors, $tbPresses)
{
  $obj = new DbConnect();
  $conn = $obj->conn;

  // Ensure the arrays have the same length
  if (count($tbNames) !== count($tbAuthors) || count($tbNames) !== count($tbPresses)) {
    echo "Error: Arrays have different lengths";
    $obj->closeConnection();
    return;
  }

  for ($i = 0; $i < count($tbNames); $i++) {
    $tbName = $tbNames[$i];
    $tbAuthor = $tbAuthors[$i];
    $tbPress = $tbPresses[$i];

    $sql = "INSERT INTO textbooks (syllabus_id, tb_name, tb_author, tb_press) VALUES ($syllabusId, '$tbName', '$tbAuthor', '$tbPress')";

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $syllabusId = $_POST["syllabus_id"];
  $tbNames = $_POST["tb_name"];
  $tbAuthors = $_POST["tb_author"];
  $tbPresses = $_POST["tb_press"];

  // Call the function to insert textbooks
  insertTextbooks($syllabusId, $tbNames, $tbAuthors, $tbPresses);
} else {
  echo "Invalid request method";
}
?>
