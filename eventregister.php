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

// Retrieve the participant details from the form
$event_id = $_POST['event_id'];
$participant_name = $_POST['participant_name'];
$participant_email = $_POST['participant_email'];
$participant_phone = $_POST['participant_phone'];
$participant_college = $_POST['participant_college'];
// Prepare the SQL statement to insert the participant details
$sql = "INSERT INTO tblparticipants (event_id, participant_name, participant_email, participant_phone, participant_college)
        VALUES ('$event_id', '$participant_name', '$participant_email', '$participant_phone', '$participant_college')";

if ($conn->query($sql) === true) {
    echo "<script>alert('Registration successful!');</script>";
} else {
    echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "');</script>";
}

// Close the connection
$conn->close();
?>
