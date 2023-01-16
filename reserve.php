<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aliftech";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the room is available
$room_id = $_POST["room_id"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];

$sql = "SELECT * FROM reservations WHERE room_id = $room_id AND (start_time BETWEEN '$start_time' AND '$end_time' OR end_time BETWEEN '$start_time' AND '$end_time')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Room is not available at the selected time.";
} else {
    // Insert a new reservation into the database
    $reserved_by = $_POST["reserved_by"];

    $sql = "INSERT INTO reservations (room_id, start_time, end_time, reserved_by) VALUES ($room_id, '$start_time', '$end_time', '$reserved_by')";

    if (mysqli_query($conn, $sql)) {

        $to = $_SESSION['email'];
        $subject = "Room Reservation Confirmation";
        $message = "Your reservation for room $room_id on $start_time has been confirmed.";
        $headers = "From: noreply@yourcompany.com";
        mail($to, $subject, $message, $headers);

        echo "Room has been successfully reserved.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
