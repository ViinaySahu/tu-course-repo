<?php
session_start();
session_regenerate_id(true);
$_SESSION['LastActiveTime'] = time();

$rootdr = "./../";
if (!isset($_GET['CourseID'])) {
  header("location: " . $rootdr);
}

$CourseID = $_GET['CourseID'];
$title = "Course " . $CourseID;

define('INCLUDED', true);
include_once($rootdr . 'assets/header.php');

include('../config/database.php');
$obj = new DbConnect();
$conn = $obj->conn;

// Fetch data from the course table
$query = "SELECT * FROM course WHERE course_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $CourseID);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($courses);
  }
}

// Fetch data from the course table
$query = "SELECT * FROM syllabus WHERE course_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $courses[0]["course_id"]);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $syllabus = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($syllabus);
  }
}

// Fetch data from the course_contents table
$query = "SELECT * FROM course_contents WHERE syllabus_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $syllabus[0]['syllabus_id']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $courseContents = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($courseContents);
  }
}

// Fetch data from the course_outcomes table
$query = "SELECT * FROM course_outcomes WHERE syllabus_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $syllabus[0]['syllabus_id']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $courseOutcomes = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($courseOutcomes);
  }
}

// Fetch data from the textbooks table
$query = "SELECT * FROM textbooks WHERE syllabus_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $syllabus[0]['syllabus_id']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $textbooks = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($textbooks);
  }
}

// Fetch data from the reference_books table
$query = "SELECT * FROM reference_books WHERE syllabus_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $syllabus[0]['syllabus_id']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $referenceBooks = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($referenceBooks);
  }
}

// Fetch data from the lab_work table
$query = "SELECT * FROM lab_work WHERE syllabus_id = ?";
if ($stmt = $conn->prepare($query)) {
  $stmt->bind_param("s", $syllabus[0]['syllabus_id']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $labWorks = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($labWorks);
  }
}

// You can now use the fetched data as needed in your HTML

if (!empty($courses)) {
  $row = $courses[0];

  // Export Button
  echo '<div class="mt-3 p-2 d-flex justify-content-end">';
  echo '<a class="btn btn-primary" href="pdf.php?CourseID=' . $row['course_id'] . '" target="_blank">Export to PDF</a>';
  echo '</div>';

  // Display the data in the desired format
  echo '<div class="container ">';
  echo '<h1>' . $row['course_code'] . ' ' . $row['course_name'] . '</h1>';
  echo '<p><strong>Credits:</strong> ' . $row['l'] + $row['t'] + $row['p'] . ' (' . $row['l'] . "L-" . $row['t'] . "T-" . $row['p'] . "P" . ')</p>';

  echo '<h2>Course Outcomes:</h2>';
  echo '<p>At the completion of this course, the students should be able to do the following:</p>';
  // Course Outcomes
  echo '<ul>';
  if (!empty($courseOutcomes)) {
    $i = 1;
    foreach ($courseOutcomes as $co) {
      $coKey = 'CO' . $i;
      if (isset($co['description'])) {
        echo '<li>' . $coKey . '. ' . $co['description'] . '</li>';
      }
      $i++;
    }
  }
  echo '</ul>';

  echo '<h2>Course Contents:</h2>';
  // Course Contents
  echo '<ul>';
  if (!empty($courseContents)) {
    foreach ($courseContents as $cc) {
      if (isset($cc['description'])) {
        echo '<li>' . $cc['description'] . '</li>';
      }
    }
  }
  echo '</ul>';

  // Text Books
  if (!empty($textbooks)) {
    echo '<h2>Text Books:</h2>';
    echo '<ol>';
    $i = 1;
    foreach ($textbooks as $tb) {
      if (isset($tb['tb_name'])) {
        echo '<li>'  . $tb['tb_name'] . ', ' . $tb['tb_author'] . ', ' . $tb['tb_press'] . '.</li>';
      }
    }
    echo '</ol>';
  }

  // Reference Books
  if (!empty($referenceBooks)) {
    echo '<h2>Reference Books:</h2>';
    echo '<ol>';
    foreach ($referenceBooks as $rb) {
      if (isset($rb['rb_name'])) {
        echo '<li>'  . $rb['rb_name'] . ', ' . $rb['rb_author'] . ', ' . $rb['rb_press'] . '.</li>';
      }
    }
    echo '</ol>';
  }
  echo '<div class="mt-3">';
  echo '<p class="watermark"><strong>Approved By:</strong> ' . ($syllabus[0]['approved_by'] ?? 'N/A') . '</p>';
  echo '<p class="watermark"><strong>Approved Date:</strong> ' . ($syllabus[0]['effective_date'] ?? 'N/A') . '</p>';
  echo '</div>';

  echo '</div>';
} else {
  echo 'No data found.';
}

$obj->closeConnection();
include_once($rootdr . 'assets/footer.php');
?>