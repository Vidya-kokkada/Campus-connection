<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $event_name = $_POST['event_name'];
        $event_description = $_POST['event_description'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $event_location = $_POST['event_location'];
        $event_category = $_POST['event_category'];

        // Check if an image file was uploaded
        if (isset($_FILES['event_image'])) {
            $event_image = $_FILES['event_image']['name'];

            // Set the target directory to save the image
            $target_dir = "event_images/";
            $target_file = $target_dir . basename($event_image);

            // Move the uploaded image to the target directory
            if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
                // Image uploaded successfully, insert the event details into the table
                $sql = "INSERT INTO tblevents (event_name, event_description, event_date, event_time, event_location, event_image, event_category) VALUES (:event_name, :event_description, :event_date, :event_time, :event_location, :event_image, :event_category)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
                $query->bindParam(':event_description', $event_description, PDO::PARAM_STR);
                $query->bindParam(':event_date', $event_date, PDO::PARAM_STR);
                $query->bindParam(':event_time', $event_time, PDO::PARAM_STR);
                $query->bindParam(':event_location', $event_location, PDO::PARAM_STR);
                $query->bindParam(':event_image', $event_image, PDO::PARAM_STR);
                $query->bindParam(':event_category', $event_category, PDO::PARAM_STR);
                $query->execute();

                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId > 0) {
                    echo '<script>alert("Event has been added.")</script>';
                    echo "<script>window.location.href ='add-events.php'</script>";
                } else {
                    echo '<script>alert("Something went wrong. Please try again.")</script>';
                }
            } else {
                echo '<script>alert("Failed to upload the image. Please try again.")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Add Event</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Event </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Event</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Add Event</h4>

                                <form class="forms-sample" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="exampleInputName1">Event Name</label>
                                        <input type="text" name="event_name" value="" class="form-control"
                                               required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDescription1">Event Description</label>
                                        <textarea class="form-control" name="event_description" rows="4"
                                                  required='true'></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDate1">Event Date</label>
                                        <input type="date" name="event_date" value="" class="form-control"
                                               required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTime1">Event Time</label>
                                        <input type="time" name="event_time" value="" class="form-control"
                                               required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputLocation1">Event Location</label>
                                        <input type="text" name="event_location" value="" class="form-control"
                                               required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputImage1">Event Image</label>
                                        <input type="file" name="event_image" class="form-control-file"
                                               id="exampleInputImage1" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCategory1">Event Category</label>
                                        <input type="text" name="event_category" value="" class="form-control"
                                               required='true'>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?php include_once('includes/footer.php'); ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>
<!-- End custom js for this page -->
</body>
</html><?php   ?>

