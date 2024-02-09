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
  <form id="referenceBooksForm">
    <div class="form-group mb-2">
      <label for="syllabus_id" class="form-label">Syllabus ID:</label>
      <select name="syllabus_id" id="syllabus" class="form-select">
        <!-- Syllabus options will be dynamically populated here -->
      </select>
    </div>

    <div id="referenceBooksContainer">
      <!-- Reference books input fields will be dynamically added here -->
    </div>

    <button type="button" class="btn btn-primary" onclick="addReferenceBook()">Add Reference Book</button>

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

  // Function to dynamically add reference book input fields
  function addReferenceBook() {
    var container = $('#referenceBooksContainer');
    var index = container.children().length;

    var html = '<div class="row mb-2">' +
      '<div class="col">' +
      '<label for="rb_name[]" class="form-label">Reference Book Name:</label>' +
      '<input type="text" name="rb_name[]" class="form-control" required>' +
      '</div>' +
      '<div class="col">' +
      '<label for="rb_author[]" class="form-label">Author:</label>' +
      '<input type="text" name="rb_author[]" class="form-control">' +
      '</div>' +
      '<div class="col">' +
      '<label for="rb_press[]" class="form-label">Press:</label>' +
      '<input type="text" name="rb_press[]" class="form-control">' +
      '</div>' +
      '</div>';

    container.append(html);
  }

  // Submit form via AJAX
  $('#referenceBooksForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '../script/insert_reference_books.php', // Replace with the actual PHP file to handle form submission
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
</script>


<?php

include_once($rootdr . "assets/footer.php");
?>