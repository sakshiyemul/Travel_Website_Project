<?php
include '../backend/connection.php';

if (isset($_GET['id'])) {
    $dest_id = $_GET['id'];

    // Optional: First delete the image file (if needed)
    $result = $conn->query("SELECT dest_image FROM destinations WHERE dest_id = $dest_id");
    $row = $result->fetch_assoc();
    $imagePath = "uploads/" . $row['dest_image'];

    if (file_exists($imagePath)) {
        unlink($imagePath); // Delete the image from the folder
    }

    // Delete the record from the table
    $sql = "DELETE FROM destinations WHERE dest_id = $dest_id";
    if ($conn->query($sql)) {
        echo "<script>
                alert('🗑️ Destination deleted successfully!');
                window.location.href = 'manage_destinations.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('❌ Error deleting destination: " . $conn->error . "');
                window.location.href = 'manage_destinations.php';
              </script>";
    }
} else {
    echo "<script>
            alert('⚠️ No destination ID provided!');
            window.location.href = 'manage_destinations.php';
          </script>";
}
?>
