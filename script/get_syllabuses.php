<?php

// Include your database connection logic
include('../config/database.php');

// Assuming you have a function to fetch syllabuses
function getSyllabuses()
{
  $obj = new DbConnect();
  $conn = $obj->conn;

  $syllabuses = array();

  $result = $conn->query("SELECT syllabus.*, course.course_code
                          FROM syllabus
                          INNER JOIN course ON syllabus.course_id = course.course_id");

  while ($row = $result->fetch_assoc()) {
    $syllabuses[] = $row;
  }

  $obj->closeConnection();

  return $syllabuses;
}


// Fetch syllabuses and return as JSON
header('Content-Type: application/json');
echo json_encode(getSyllabuses());
?>