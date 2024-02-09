<?php
if (!defined('INCLUDED')) {
  die('Access denied');
}

if (!isset($title)) {
  $title = "TU Course Repo Home";
}

if (!isset($rootdr)) {
  $rootdr = "../";
}

if (!isset($_SESSION['email'])) {
  header("location: " . $rootdr);
}
?>
<!-- Header content here -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= $rootdr ?>assets/images/tu2.ico" type="image/x-icon">

  <!-- Title -->
  <title>
    <?= $title ?>
  </title>

  <!-- Bootstrap And Javascript -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- CSS File -->
  <link rel="stylesheet" href="<?= $rootdr ?>assets/style.css">
  <link rel="shortcut icon" href="<?= $rootdr ?>favicon.ico">
</head>

<!-- B O D Y -->

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <!-- Logo -->
    <a href="<?= $rootdr ?>" class="navbar-brand">
      <img src="<?= $rootdr ?>assets/images/tu.ico" alt="Tezpur University Logo" height="40" width="40">
      <span class="fs-4 fw-bold">Tezpur University</span>
    </a>
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <!-- Navbar Elements -->
      <ul class="navbar-nav ms-auto">
        <!-- <li class="nav-item"><a class="nav-link" href="people.html">Home</a></li> -->
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addcourse.php">Add New Course</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addsyllabus.php">Add Syllabus</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addco.php">Add Course Objective</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addcc.php">Add Course Contants</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addlabwork.php">Add Lab Work</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addtextbook.php">Add Text Books</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $rootdr ?>admin/addreferencebooks.php">Add Reference
            Books</a></li>
        <?php if (!isset($_SESSION['email'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $rootdr ?>login.php">
              <button class="btn btn-primary btn-sm">Login</button>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $rootdr ?>script/logout.php">
              <button class="btn btn-danger btn-sm">Logout</button>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>