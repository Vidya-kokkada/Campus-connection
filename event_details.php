<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Get the event ID from the URL parameter
if (isset($_GET['id'])) {
    $eventID = $_GET['id'];

    // Retrieve event details from the database based on the event ID
    $sql = "SELECT * FROM tblevents WHERE ID = :eventID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eventID', $eventID, PDO::PARAM_INT);
    $query->execute();
    $event = $query->fetch(PDO::FETCH_OBJ);

    // Check if the event exists
    if (!$event) {
        header("Location: index.php"); // Redirect to the homepage if event not found
        exit();
    }
} else {
    header("Location: index.php"); // Redirect to the homepage if event ID not provided
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Details - <?php echo $event->event_name; ?></title>
    <!-- Include your CSS stylesheets and other head elements here -->
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!--coustom css-->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<!--script-->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- js -->
<script src="js/bootstrap.js"></script>
<!-- /js -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--/fonts-->
<!--hover-girds-->
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<!--/hover-grids-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="event-details">
        <div class="container">
            <h2><?php echo $event->event_name; ?></h2>
            <div class="event-info">
                <img src="./admin/event_images/<?php echo $event->event_image; ?>" alt="<?php echo $event->event_name; ?>">
                <p><?php echo $event->event_description; ?></p>
                <p>Date: <?php echo $event->event_date; ?></p>
                <p>Time: <?php echo $event->event_time; ?></p>
                <p>Location: <?php echo $event->event_location; ?></p>
                <p>Category: <?php echo $event->event_category; ?></p>
				 <!--  <button class="book-now-button" onclick="showRegistrationForm(<?php echo $row["ID"]; ?>)">Book Now</button>-->
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
