<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
  header('location: logout.php');
} else {
  // Code for deletion
  if (isset($_GET['delid'])) {
    $feedbackId = intval($_GET['delid']);
    $sql = "DELETE FROM feedback WHERE id=:feedbackId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':feedbackId', $feedbackId, PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Feedback deleted');</script>";
    echo "<script>window.location.href = 'view-feedback.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
  <title>Student Management System - View Feedback</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    h1 {
      color: #333;
      text-align: center;
      padding: 20px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    a {
      color: #333;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .delete-link {
      color: #f44336;
      font-weight: bold;
    }

    .delete-link:hover {
      text-decoration: none;
    }

    .message-column {
      width: 40%;
    }

    .created-at-column {
      width: 15%;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
  <?php include_once('includes/header.php');?>
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
    <!-- partial -->
        <div class="main-panel">
  <table>
    <thead>
      <tr>
        <th>Serial No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th class="message-column">Message</th>
        <th class="created-at-column">Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM feedback";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $row) {
        ?>
        <tr>
          <td><?php echo $cnt; ?></td>
          <td><?php echo $row->name; ?></td>
          <td><?php echo $row->email; ?></td>
          <td><?php echo $row->mobile; ?></td>
          <td><?php echo $row->message; ?></td>
          <td><?php echo $row->created_at; ?></td>
          <td>
            <a class="delete-link" href="view-feedback.php?delid=<?php echo $row->id; ?>" onclick="return confirm('Do you really want to delete this feedback?');">Delete</a>
          </td>
        </tr>
        <?php
        $cnt++;
      }
    } else {
      ?>
      <tr>
        <td colspan="7">No feedback available</td>
      </tr>
      <?php
    }
    ?>
    </tbody>
  </table>
      </div>
	  </div>
	  
	   </div>
        <!-- main-panel ends -->
	  <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>
<?php } ?>
