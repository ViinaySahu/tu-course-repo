<?php
session_start();
if (!isset($rootdr)) {
  $rootdr = "../";
}
//session_regenerate_id(true);
$_SESSION['LastActiveTime'] = time();

if (!isset($title)) {
  $title = "Course Admin";
}

define('INCLUDED', true);
include_once($rootdr . "admin/header.php");
?>



<div class="container p-5">
  <form id="syllabusForm">
    <div class="row">
      <div class="form-group mb-2 col">
        <label for="course_id" class="form-label">Course ID:</label>
        <select name="course_id" id="course" class="form-select">
          <!-- Course options will be dynamically populated here -->
        </select>
      </div>
      <div class="form-group mb-2 col">
        <label for="version_number" class="form-label">Version Number:</label>
        <input type="number" name="version_number" class="form-control" step="0.1" required>
      </div>

      <div class="form-group mx-sm-3 mb-2 col">
        <label for="effective_date" class="form-label">Effective Date:</label>
        <input type="date" name="effective_date" class="form-control" required>
      </div>
    </div>

    <div class="form-group mb-2">
      <label for="approved_by" class="form-label">Approved By:</label>
      <input type="text" name="approved_by" class="form-control">
    </div>

    <div class="form-group mx-sm-3 mb-2">
      <label for="approval_num" class="form-label">Approval Number:</label>
      <input type="text" name="approval_num" class="form-control">
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
</div>

<!-- jQuery library (required for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // Fetch course names via AJAX
  $(document).ready(function () {
    $.ajax({
      url: '../script/cseCourse.php', // Replace with the actual PHP file to fetch courses
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Populate course dropdown with fetched data
        if (data.length > 0) {
          data.forEach(function (course) {
            $('#course').append('<option value="' + course.course_id + '">' + course.course_name + '</option>');
          });
        } else {
          $('#course').append('<option value="">No courses found</option>');
        }
      },
      error: function () {
        console.error('Error fetching courses data');
      }
    });

    // Submit form via AJAX
    $('#syllabusForm').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: '../script/insert_syllabus.php', // Replace with the actual PHP file to handle form submission
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
          alert(response); // Display the response from the server (e.g., "New record created successfully")
          // You can add more logic here based on the response
        },
        error: function () {
          console.error('Error submitting form');
        }
      });
    });
  });
</script>

<?php

include_once($rootdr . "assets/footer.php");
?>