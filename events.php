<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>



<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <style>
        /* Add some basic styling for the events */
        .event-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
		
        
            display: inline-block;
            width: 300px;
            vertical-align: top;
            box-sizing: border-box;
        }
        .event-image {
            max-width: 250px;
        }
    </style>
    <script>
        function showRegistrationForm(eventId) {
            // Get the participant details from the user
            var name = prompt("Enter your name:");
            var email = prompt("Enter your email:");
            var phone = prompt("Enter your phone number:");
			var college=prompt("Enter your college name:");

            if (name && email && phone && college) {
                // Create a new form element
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "eventregister.php";

                // Create hidden input for the event ID
                var eventIdInput = document.createElement("input");
                eventIdInput.type = "hidden";
                eventIdInput.name = "event_id";
                eventIdInput.value = eventId;
                form.appendChild(eventIdInput);

                // Create input for participant name
                var nameInput = document.createElement("input");
                nameInput.type = "text";
                nameInput.name = "participant_name";
                nameInput.value = name;
                form.appendChild(nameInput);

                // Create input for participant email
                var emailInput = document.createElement("input");
                emailInput.type = "email";
                emailInput.name = "participant_email";
                emailInput.value = email;
                form.appendChild(emailInput);

                // Create input for participant phone
                var phoneInput = document.createElement("input");
                phoneInput.type = "tel";
                phoneInput.name = "participant_phone";
                phoneInput.value = phone;
                form.appendChild(phoneInput);
				
				// create input for college 
				var collegeInput = document.createElement("input");
                collegeInput.type = "text";
                collegeInput.name = "participant_college";
                collegeInput.value = college;
                form.appendChild(collegeInput);
                // Submit the form
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
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
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--script-->
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
<!--header-->
		<?php include_once('includes/header.php');?>
    <h1>Events</h1>

    <?php
    // Replace database connection details with your own
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentmsdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch events from the tblevents table
    $sql = "SELECT * FROM tblevents";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="event-container">
                <?php if ($row["event_image"] != '') { ?>
                    <img src="./admin/event_images/<?php echo $row["event_image"]; ?>" alt="Event Image" class="event-image">
                <?php } ?>
                <h2><?php echo $row["event_name"]; ?></h2>
                <p>Date: <?php echo $row["event_date"]; ?></p>
                <p>Time: <?php echo $row["event_time"]; ?></p>
                <p>Location: <?php echo $row["event_location"]; ?></p>
                <p>Description: <?php echo $row["event_description"]; ?></p>
                <p>Category: <?php echo $row["event_category"]; ?></p>
                <button class="book-now-button" onclick="showRegistrationForm(<?php echo $row["ID"]; ?>)">Register</button>
            </div>
            <?php
        }
    } else {
        echo "No events found.";
    }

    // Close the connection
    $conn->close();
    ?>
<?php include_once('includes/footer.php');?>
</body>
</html>
