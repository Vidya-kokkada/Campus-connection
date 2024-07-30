<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']) == 0) {
  header('location: logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Management System || View Result</title>
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
  <link rel="stylesheet" href="css/style.css" />
  
  
  <!-- lightgallery CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery/dist/css/lightgallery.min.css">

<!-- lightgallery JS -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery/dist/js/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lg-thumbnail/dist/lg-thumbnail.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lg-video/dist/lg-video.min.js"></script>

  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">View Result</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Result</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered mg-b-0">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Result Title</th>
                        <th>Class</th>
                        <th>Result Image</th>
                        <th>Created Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					
                      $sql = "SELECT * FROM tblresult";
                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);

                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                          ?>
                          <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row->ResultTitle; ?></td>
                            <td><?php echo $row->ClassId; ?></td>
							
							<td>
  <a href="../admin/result_images/<?php echo $row->ResultImage; ?>" class="lg-zoom-in">
    <img src="../admin/result_images/<?php echo $row->ResultImage; ?>" alt="Result Image" width="100">
  </a>
</td>

                           
                            <td><?php echo $row->CreatedDate; ?></td>
                          </tr>
                          <?php
                          $cnt++;
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="5">No results found</td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once('includes/footer.php');?>
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
  
  <script>
  $(document).ready(function() {
    $('.table').lightGallery({
      selector: '.lg-zoom-in',
      download: false, // Disable download button if not needed
      thumbnail: true // Enable thumbnails
    });
  });
</script>

</body>
</html>
<?php } ?>
