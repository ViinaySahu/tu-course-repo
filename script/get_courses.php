<?php
// Include your database connection script here
include('../config/database.php');
$obj = new DbConnect();
$conn = $obj->conn;

if (isset($_GET['departmentId'])) {
  $departmentId = $_GET['departmentId'];

  $query = "SELECT course_id, course_code, course_name FROM course WHERE department_id = ?";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $departmentId);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $courses = $result->fetch_all(MYSQLI_ASSOC);
      // var_dump($courses);
      $count = 1;
      $table = '<table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Sr</th>
                      <th scope="col">Course Code</th>
                      <th scope="col">Course Name</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">';
      foreach ($courses as $course) {
        $table .= '<tr>
                    <th scope="row">' . $count . '</th>
                    <td><a href="./course/details.php?CourseID=' . $course['course_id'] . '">' . $course['course_code'] . '</a></td>
                    <td>' . $course['course_name'] . '</td>
                  </tr>';
        $count++;
      }
      $table . '</tbody> </table>';
      echo $table;
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

<?php
// include('../config/database.php'); // Adjust the path based on your file structure

// // Create a database connection
// $obj = new DbConnect();
// $conn = $obj->conn;

// // Check if the connection is successful
// if (!$conn) {
//     die('Database connection failed: ' . mysqli_connect_error());
// }

// // Fetch course data
// $sql = "SELECT course_id, course_code, course_name FROM course WHERE department_id = ?";
// $result = mysqli_query($conn, $sql);

// if (!$result) {
//     die('Error fetching courses: ' . mysqli_error($conn));
// }

// // Store the results in an array
// $courses = array();
// while ($row = mysqli_fetch_assoc($result)) {
//     $courses[] = $row;
// }

// // Close the database connection
// $obj->closeConnection();

// // Send the data as JSON
// header('Content-Type: application/json');
// echo json_encode($courses);
?>
