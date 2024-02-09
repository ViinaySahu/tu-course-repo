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
  <form id="courseContentsForm">
    <div class="form-group mb-2">
      <label for="syllabus_id" class="form-label">Syllabus ID:</label>
      <select name="syllabus_id" id="syllabus" class="form-select">
        <!-- Syllabus options will be dynamically populated here -->
      </select>
    </div>

    <div id="courseContentsFields">
      <!-- Dynamic fields will be added here -->
    </div>

    <button type="button" class="btn btn-primary" onclick="addCourseContentsField()">Add Course Contents</button>

    <input type="submit" value="Submit" class="btn btn-primary mt-3">
  </form>
</div>

<!-- jQuery library (required for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // Fetch syllabus names via AJAX
  $(document).ready(function () {
    $.ajax({
      url: '../script/get_syllabuses.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.length > 0) {
          data.forEach(function (syllabus) {
            $('#syllabus').append('<option value="' + syllabus.syllabus_id + '">' + syllabus.course_code + ' V' + syllabus.version_number + '</option>');
          });
        } else {
          $('#syllabus').append('<option value="">No syllabuses found</option>');
        }
      },
      error: function () {
        console.error('Error fetching syllabuses data');
      }
    });
  });

  // Function to add dynamic course contents fields
  function addCourseContentsField() {
    var fieldHtml = '<div class="form-group mb-2">' +
      '<label for="description" class="form-label">Description:</label>' +
      '<textarea name="description[]" class="form-control"></textarea>' +
      '</div>';

    $('#courseContentsFields').append(fieldHtml);
  }

  // Submit form via AJAX
  $('#courseContentsForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '../script/insert_course_contents.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        alert(response);
        // You can add more logic here based on the response
      },
      error: function () {
        console.error('Error submitting form');
      }
    });
  });
</script>
<?php

include_once($rootdr . "assets/footer.php");
?>