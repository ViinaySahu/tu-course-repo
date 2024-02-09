<?php
$rootdr = "./../";
if (!isset($_GET['CourseID'])) {
  header("location: " . $rootdr);
}

$CourseID = $_GET['CourseID'];
$title = "Course " . $CourseID;

require('../fpdf186/fpdf.php');
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


class PDF extends FPDF
{
  function Header()
  {
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(0, 10, 'Course Details', 0, 1, 'C');
  }

  function ChapterTitle($title)
  {
    $this->SetFont('Arial', 'B', 14);
    $this->Cell(0, 10, $title, 0, 1, 'L');
  }

  function ChapterBody($body)
  {
    $this->SetFont('Arial', '', 12);
    $this->MultiCell(0, 10, $body);
  }

  function ChapterList($list)
  {
    $this->SetFont('Arial', '', 12);
    $this->Ln(5);
    $this->Cell(0, 10, $list, 0, 1);
  }
}

if (!empty($courses)) {
  $row = $courses[0];

  // Create PDF
  $pdf = new PDF();
  $pdf->AddPage();

  // Syllabus Title
  $pdf->ChapterTitle($row['course_code'] . ': ' . $row['course_name']);

  // Syllabus Semester
  // $pdf->ChapterBody('Semester: ' . $row['Semester']);

  // Syllabus Outcomes
  $pdf->ChapterTitle('Course Outcomes');
  $pdf->ChapterList('At the completion of this syllabus, the students should be able to do the following:');
  if (!empty($courseOutcomes)) {
    $i = 1;
    foreach ($courseOutcomes as $co) {
      $coKey = 'CO' . $i;
      if (isset($co['description'])) {
        $pdf->ChapterBody($coKey . '. ' . $co['description']);
      }
      $i++;
    }
  }

  // Syllabus Contents
  $pdf->ChapterTitle('Course Contents');
  if (!empty($courseContents)) {
    foreach ($courseContents as $cc) {
      if (isset($cc['description'])) {
        $pdf->ChapterBody('  - ' . trim($cc['description']));
      }
    }
  }

  // Syllabus Text Books
  if (!empty($textbooks)) {
    $pdf->ChapterTitle('Text Books');
    foreach ($textbooks as $tb) {
      if (isset($tb['tb_name'])) {
        $pdf->ChapterBody('  - ' . $tb['tb_name'] . ', ' . $tb['tb_author'] . ', ' . $tb['tb_press']);
      }
    }
  }

  // Reference Books
  if (!empty($referenceBooks)) {
    $pdf->ChapterTitle('Reference Books');
    foreach ($referenceBooks as $rb) {
      if (isset($rb['rb_name'])) {
        $pdf->ChapterBody('  - ' . $rb['rb_name'] . ', ' . $rb['rb_author'] . ', ' . $rb['rb_press']);
      }
    }
  }

  // Syllabus Lab Works
  if (!empty($labWorks)) {
    $pdf->ChapterTitle('Lab Works');
    foreach ($labWorks as $lw) {
      if (isset($lw['description'])) {
        $pdf->ChapterBody('  - ' . trim($lw['description']));
      }
    }
  }

  // Approved By and Approved Date as Watermark
  $pdf->SetTextColor(200, 200, 200); // Set color to light gray with reduced opacity (alpha)
  $pdf->SetFont('Arial', 'I', 12); // Set font to italic

  // $pdf->ChapterTitle('Approval Information');
  $pdf->ChapterBody('Approved By: ' . ($syllabus[0]['approved_by'] ?? 'N/A'));
  $pdf->ChapterBody('Approved Date: ' . ($syllabus[0]['effective_date'] ?? 'N/A'));

  // Reset color and font
  $pdf->SetTextColor(0, 0, 0); // Reset color to black
  $pdf->SetFont('Arial', '', 12); // Reset font to normal

  // Output PDF
  $pdf->Output($row['course_code'], 'I');
} else {
  echo 'No data found.';
}

// Close the database connection
$obj->closeConnection();
?>