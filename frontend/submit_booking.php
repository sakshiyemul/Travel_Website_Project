<?php
include '../backend/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dest_id = $_POST['dest_id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $travel_date = $_POST['travel_date'];
    $travelers = $_POST['travelers'];

    $sql = "INSERT INTO bookings (dest_id, full_name, email, phone, travel_date, travelers) 
            VALUES ('$dest_id', '$full_name', '$email', '$phone', '$travel_date', '$travelers')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking successful!'); window.location.href='destinations.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
