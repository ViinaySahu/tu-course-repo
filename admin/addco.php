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
  <form id="courseOutcomesForm">
    <div class="form-group mb-2">
      <label for="syllabus_id" class="form-label">Syllabus ID:</label>
      <select name="syllabus_id" id="syllabus" class="form-select">
        <!-- Syllabus options will be dynamically populated here -->
      </select>
    </div>

    <div id="courseOutcomesFields">
      <!-- Course Outcomes fields will be dynamically added here -->
      <div class="row">
        <div class="form-group mb-2 col">
          <label for="description" class="form-label">Course Outcome:</label>
          <input type="text" name="description[]" class="form-control">
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-success" id="addCourseOutcome">+</button>

    <input type="submit" value="Submit" class="btn btn-primary">
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
            $('#syllabus').append('<option value="' + syllabus.syllabus_id + '">' + syllabus.course_code + ' ' + syllabus.version_number + '</option>');
          });
        } else {
          $('#syllabus').append('<option value="">No syllabuses found</option>');
        }
      },
      error: function () {
        console.error('Error fetching syllabuses data');
      }
    });

    // Add dynamic Course Outcomes fields
    $('#addCourseOutcome').click(function () {
      $('#courseOutcomesFields').append('<div class="row"><div class="form-group mb-2 col"><label for="description" class="form-label">Course Outcome:</label><input type="text" name="description[]" class="form-control"></div></div>');
    });

    // Submit form via AJAX
    $('#courseOutcomesForm').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: '../script/insert_course_outcomes.php', // Replace with the actual PHP file to handle form submission
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
          alert(response); // Display the response from the server (e.g., "New records created successfully")
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