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
  <form id="textbooksForm">
    <div class="form-group mb-2">
      <label for="syllabus_id" class="form-label">Syllabus ID:</label>
      <select name="syllabus_id" id="syllabus" class="form-select">
        <!-- Syllabus options will be dynamically populated here -->
      </select>
    </div>

    <div id="textbookFields">
      <div class="row">
        <div class="form-group mb-2 col">
          <label for="tb_name" class="form-label">Textbook Name:</label>
          <input type="text" name="tb_name[]" class="form-control" required>
        </div>
        <div class="form-group mb-2 col">
          <label for="tb_author" class="form-label">Textbook Author:</label>
          <input type="text" name="tb_author[]" class="form-control">
        </div>
        <div class="form-group mx-sm-3 mb-2 col">
          <label for="tb_press" class="form-label">Textbook Press:</label>
          <input type="text" name="tb_press[]" class="form-control">
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-primary" onclick="addTextbookFields()">Add Textbook</button>
    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
</div>

<!-- jQuery library (required for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // Fetch syllabus names via AJAX
  $(document).ready(function () {
    $.ajax({
      url: '../script/get_syllabuses.php', // Replace with the actual PHP file to fetch syllabuses
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Populate syllabus dropdown with fetched data
        if (data.length > 0) {
          data.forEach(function (syllabus) {
            $('#syllabus').append('<option value="' + syllabus.syllabus_id + '">' + syllabus.course_code + " V" + syllabus.version_number + '</option>');
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

  // Function to add more textbook fields
  function addTextbookFields() {
    var html = '<div class="row">' +
      '<div class="form-group mb-2 col">' +
      '<label for="tb_name" class="form-label">Textbook Name:</label>' +
      '<input type="text" name="tb_name[]" class="form-control" required>' +
      '</div>' +
      '<div class="form-group mb-2 col">' +
      '<label for="tb_author" class="form-label">Textbook Author:</label>' +
      '<input type="text" name="tb_author[]" class="form-control">' +
      '</div>' +
      '<div class="form-group mx-sm-3 mb-2 col">' +
      '<label for="tb_press" class="form-label">Textbook Press:</label>' +
      '<input type="text" name="tb_press[]" class="form-control">' +
      '</div>' +
      '</div>';

    $('#textbookFields').append(html);
  }

  // Submit form via AJAX
  $('#textbooksForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '../script/insert_textbooks.php', // Replace with the actual PHP file to handle form submission
      type: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        alert(response); // Display the response from the server
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