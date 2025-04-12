<?php
include '../backend/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE booking_id=$id";

    if ($conn->query($sql)) {
        echo "<script>
                alert('Booking deleted successfully!');
                window.location.href='manage_bookings.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting booking: " . $conn->error . "');
                window.location.href='manage_bookings.php';
              </script>";
    }
}
?>
