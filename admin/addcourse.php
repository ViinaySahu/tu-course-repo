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
  <form id="courseForm">
    <label for="course_code" class="form-label">Course Code:</label>
    <input type="text" name="course_code" class="form-control" required placeholder="AB123"><br>

    <label for="course_name" class="form-label">Course Name:</label>
    <input type="text" name="course_name" class="form-control" required placeholder="Data Structure"><br>

    <label for="corequisite" class="form-label">Pre-requisite:</label>
    <input type="text" name="corequisite" class="form-control" placeholder="Pre-requisite course"><br>

    <div class="row">
      <div class="form-group mb-2 col">
        <label for="l" class="form-label">Lecture Hours:</label>
        <select name="l" class="form-select" min="0">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <div class="form-group mb-2 col">

        <label for="t" class="form-label">Tutorial Hours:</label>
        <select name="t" class="form-select" min="0">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>

      <div class="form-group mx-sm-3 mb-2 col">

        <label for="p" class="form-label">Practical Hours:</label>
        <select name="p" class="form-select" min="0">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
    </div>

    <label for="abstract" class="form-label">Abstract:</label>
    <textarea name="abstract" class="form-control"></textarea><br>

    <label for="department_id" class="form-label">Department:</label>
    <select name="department_id" id="department" class="form-select">
      <!-- Department options will be dynamically populated here -->
    </select><br>

    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
</div>

<!-- jQuery library (required for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // Fetch department names via AJAX
  $(document).ready(function () {
    $.ajax({
      url: '../script/cseDepartment.php', // Replace with the actual PHP file to fetch departments
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Populate department dropdown with fetched data
        if (data.length > 0) {
          data.forEach(function (department) {
            $('#department').append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
          });
        } else {
          $('#department').append('<option value="">No departments found</option>');
        }
      },
      error: function () {
        console.error('Error fetching departments data');
      }
    });

    // Submit form via AJAX
    $('#courseForm').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: '../script/insert_course.php', // Replace with the actual PHP file to handle form submission
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