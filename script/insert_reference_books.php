<?php

// Include your database connection logic
include('../config/database.php');

// Assuming you have a function to insert reference books
function insertReferenceBooks($syllabusId, $rbNames, $rbAuthors, $rbPresses)
{
  $obj = new DbConnect();
  $conn = $obj->conn;

  // Ensure the arrays have the same length
  if (count($rbNames) !== count($rbAuthors) || count($rbNames) !== count($rbPresses)) {
    echo "Error: Arrays have different lengths";
    $obj->closeConnection();
    return;
  }

  for ($i = 0; $i < count($rbNames); $i++) {
    $rbName = $rbNames[$i];
    $rbAuthor = $rbAuthors[$i];
    $rbPress = $rbPresses[$i];

    $sql = "INSERT INTO reference_books (syllabus_id, rb_name, rb_author, rb_press) VALUES ($syllabusId, '$rbName', '$rbAuthor', '$rbPress')";

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
  $rbNames = $_POST["rb_name"];
  $rbAuthors = $_POST["rb_author"];
  $rbPresses = $_POST["rb_press"];

  // Call the function to insert reference books
  insertReferenceBooks($syllabusId, $rbNames, $rbAuthors, $rbPresses);
} else {
  echo "Invalid request method";
}
?>