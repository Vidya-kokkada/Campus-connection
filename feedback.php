<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        .form-group textarea {
            height: 100px;
        }
        
        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .success {
            background-color: #DFF0D8;
            color: #3C763D;
            padding: 10px;
            margin-bottom: 10px;
        }
        
        .error {
            background-color: #F2DEDE;
            color: #A94442;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
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

</head>
<body>
<!--header-->
		<!--header-->
    <div class="header" id="home">
      <nav class="navbar navbar-default">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
          </button>
		    <a href="index.php"><span data-hover="Home">Home</span></a>
          <h1><a class="navbar-brand" href="index.php">CampusConnection</a></h1>
          </div>
   
              
              
              
           
         
              
            
        <!-- /.container-fluid -->

      </nav>
<!--/script-->
       <div class="clearfix"> </div>
</div>
<!-- Top Navigation -->

<!--header-->
    <h1>Feedback Form</h1>
    <div class="container">
        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $message = $_POST['message'];
            
            // Validate form data (you can add more validation if required)
            if (empty($name) || empty($email) || empty($mobile) || empty($message)) {
                echo '<div class="error">All fields are required.</div>';
            } else {
                // Connect to the database (change these settings according to your database configuration)
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'studentmsdb';
                
                $conn = new mysqli($host, $username, $password, $database);
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Insert form data into the database table (change "feedback" to your desired table name)
                $sql = "INSERT INTO feedback (name, email, mobile, message) VALUES ('$name', '$email', '$mobile', '$message')";
                
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="success">Thank you for your feedback!</div>';
                } else {
                    echo '<div class="error">Error: ' . $conn->error . '</div>';
                }
                
                // Close the database connection
                $conn->close();
            }
        }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" pattern="[A-Za-z\s]+" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="tel" name="mobile" id="mobile" pattern="[0-9]+"  required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>
