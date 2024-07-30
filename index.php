<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Retrieve three latest events from the database
$sql = "SELECT * FROM tblevents ORDER BY ID DESC LIMIT 3";
$query = $dbh->prepare($sql);
$query->execute();
$events = $query->fetchAll(PDO::FETCH_OBJ);





?>
<!doctype html>
<html>
<head>
<title>Campus Connection || Home Page</title>
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

  <style>
  .slider {
  position: relative;
  height: 600px;
  overflow: hidden;
}

.slider img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.slider img.active {
  opacity: 1;
}


  </style>


  
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<!--/script-->


</head>
	<body>
<?php include_once('includes/header.php');?>

<div class="slider">
   
    <img src="images/college.jpg" alt="Slide 1">
    <img src="images/event2.jpg" alt="Slide 2">
	<img src="images/clg2.jpg" alt="Slide 3">
	<img src="images/evnt1.jpg" alt="Slide 4">
  </div>

  
  
<div class="welcome">
	<div class="container">
		<?php
$sql="SELECT * from tblpage where PageType='aboutus'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
		<h2><?php  echo htmlentities($row->PageTitle);?></h2>
		<p><?php  echo ($row->PageDescription);?></p><?php $cnt=$cnt+1;}} ?>
	</div>
</div>
<!--/welcome-->


  <!-- Event Section -->
  <div class="events" >
    <div class="container">
      <h3>Upcoming Events</h3>
      <div class="row"  >
        <?php foreach($events as $event): ?>
          <div class="col-md-4">
            <div class="event" >
              <img src="./admin/event_images/<?php echo $event->event_image; ?>" alt="<?php echo $event->event_name; ?>"  style="margin-right:10px;height:350px;width:350px;">
              <h4><?php echo $event->event_name; ?></h4>
              <p><?php echo $event->event_date; ?> at <?php echo $event->event_time; ?></p>
              <p><?php echo $event->event_location; ?></p>
              <a href="event_details.php?id=<?php echo $event->ID; ?>">View Details</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!-- /Event Section -->





<!--testmonials-->
<div class="testimonials">
	<div class="container">
			<div class="testimonial-nfo">
        <h3>Public Notices</h3>
         <marquee  style="height:350px;" direction ="up" onmouseover="this.stop();" onmouseout="this.start();">
				<?php
$sql="SELECT * from tblpublicnotice";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>

 
		<a href="view-public-notice.php?viewid=<?php echo htmlentities ($row->ID);?>" target="_blank" style="color:#fff;">
          <?php  echo htmlentities($row->NoticeTitle);?>(<?php  echo htmlentities($row->CreationDate);?>)</a>
          <hr /><br />
				    
			<?php $cnt=$cnt+1;}} ?>
	</marquee></div>
	</div>
</div>
<!--\testmonials-->
<!--specfication-->

<!--/specfication-->
<?php include_once('includes/footer.php');?>
<!--/copy-rights-->

<script>
    const sliderImages = document.querySelectorAll('.slider img');
    let currentImage = 0;

    // Set the first image to be active
    sliderImages[currentImage].classList.add('active');

    // Start the slider
    setInterval(() => {
      sliderImages[currentImage].classList.remove('active');
      currentImage = (currentImage + 1) % sliderImages.length;
      sliderImages[currentImage].classList.add('active');
    }, 5000);
  </script>
	</body>
</html>
